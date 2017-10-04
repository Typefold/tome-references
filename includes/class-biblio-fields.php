<?php
/**
* Is used to handle creating Form for Bibliographic Entry
*/
class Biblio_Fields
{
	
	protected $fields_arr; // Array of fields that can be printed / used for the form
	protected $repeater_counter ; // Counter for repeater fields
	protected $biblio_style; // Eg. MLA, Chicago, Custom
	protected $biblio_source; // EG. book, ebbok, chapter_or_other_part
	protected $form_values; // EG. book, ebbok, chapter_or_other_part
	protected $is_edit; // EG. book, ebbok, chapter_or_other_part

	function __construct( $biblio_style, $biblio_source = 'custom', $biblio_id )
	{

		$this->fields_arr = $this->choose_form_fields( $biblio_style );


		$this->repeater_counter = 0;
		$this->biblio_source = $biblio_source;

		if ( $biblio_id ) {
			$this->form_values = get_post_custom( $biblio_id );
			$this->is_edit = true;
		}

	}


	/**
	 * @param  $biblio_style (string) - Type of bibliographyc entry e.g. ("MLA", "Chicago") 
	 * @param  $biblio_source (string) - Type of source of bibliographyc entry e.g. ('single_or_multiple_author_book, ebook, website')
	 * @param  $values (array) - This variable is used when we want to EDIT biblio entry, so the form already has values.
	 * @return void - Prints out the biblio form fields.
	 */
	public function print_form() {

		$form_html = "";


		foreach ( $this->fields_arr[ $this->biblio_source ] as $section ) {

			if( empty( $section ) )
				continue;

			$title = $section['title'];

			$form_html .= "<div class='form-section'>";


				// section title ( if there is any )
				$form_html .= ( ! empty( $title ) ) ? "<h3>$title</h3>" : "";


				$form_html .= $this->get_section_fields( $section );


			$form_html .= "</div>";
		}

		return $form_html;
	}


	private function choose_form_fields( $biblio_style ) {

		switch ( $biblio_style ) {
			case 'mla':
				$fields_arr = require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/mla-fields-vertical.php';
			break;

			case 'chicago':
				$fields_arr = require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/chicago-fields-vertical.php';
			break;
			
			case 'custom':
				$fields_arr = require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom-fields.php';
			break;
			
			default:
			break;
		}

		return $fields_arr;

	}


	private function get_section_fields( $section ) {

		$output = "";

		foreach ($section['fields'] as $field) {


			if ( ! empty( $field['repeater'] ) ) {

				$output .= $this->get_repeater_fields( $field );

			} else {

				$output .= $this->get_field( $field );

			}


		}

		return $output;
	}


	/**
	 * @param  $section - section of fields to be printed
	 * @return void - When the section is of a type "Repeater" then there is a different slightly way how to print it
	 */
	private function get_repeater_fields( $repeater ) {

		$this->repeater_counter = 0;

		$repeater_name = $repeater['repeater'];
		$repeater_val = unserialize( $this->form_values[ $repeater_name ][0] );

		$repeater_count = count( $repeater_val['first_name'] );
		$repeater_count = ( $repeater_count == 0 ) ? 1 : $repeater_count;

		$output = "";

		for ($i=0; $i < $repeater_count; $i++) {

			$repeater_title = $repeater['title'];
			$repeater_name = $repeater['repeater'];

			$output .= "<div class='fields-section' data-repeater-name='$repeater_name'>

				<span>$repeater_title</span>";

				foreach ($repeater['fields'] as $field) {
					$output .= $this->get_field( $field );
				}

			$output .= "<a href='javascript:;' class='repeat-section' data-repeat-name='$repeater_name'>Add $repeater_name</a>";
			$output .= "<a href='javascript:;' class='remove-section dashicons dashicons-trash'></a>";

			$output .= "</div>";

			$this->repeater_counter++;
		}

		return $output;
	}





	private function get_field( $field ) {

		$field_type = $field['type'];
		$field_label =  ( isset( $field['label'] ) ) ? $field['label'] : "";
		$hidden = ( isset( $field['hidden'] ) ) ? $field['hidden'] : "";
		$field_class = ( isset( $field['class'] ) ) ? $field['class'] : "";
		$field_value = ( isset( $field['value'] ) ) ? $field['value'] : "";
		$field_name = $this->field_name($field);
		$field_validation = $this->field_validation( $field['validation'] );
		$field_class = 'biblio-input ' . $field_class;


		if ( isset( $field['repeater_children'] ) ) {

			return $this->repeater_field( $field_type, $field_label, $field_name, $field_validation, $input_class );

		} elseif ( $field_type == 'selectbox' ) {

			return $this->get_selectbox( $field );

		} elseif ( $field_type == 'textarea' ) {

			return $this->get_textarea( $field );

		}


		return $this->get_input_field( $field_type, $field_label, $field_name, $field_validation, $field_class, $field_value, $hidden );
	}



	/**
	 * Takes an array of an element attrbiutes and formats
	 * them into string eg. disabled="disabled" data-something="value"
	 * @return string
	 */
	private function format_other_form_attributes( $attributes ) {

		if ( gettype($attributes) !== 'array' )
			return "You didn't pass an error";

		$attributes_string = ' ';

		foreach ( $attributes as $attribute => $att_value ) {

			$attributes_string .= $attribute . ' ="' . $att_value . '"';

		}

		return $attributes_string;

	}


	private function repeater_field( $type, $placeholder, $name, $validation, $field_class ) {
		return "<div class='input-wrapp'>
			<input 
				type='$type'
				name='$name'
				placeholder='$placeholder'
				class='$field_class'>
		</div>";
	}


	private function get_selectbox( $field ) {

		// it's easier to work with an object in a string than with an array
		$field = (object)$field;

		$ouput = "<div class='input-wrapp'>";

			$ouput .= "<select name='$field->name' class='$field->class'>";

				foreach ( $field->options as $value => $value_text ) {

					$ouput .= "<option value='$value'>$value_text</option>";
				}

			$ouput .= "</select>";

		$ouput .= "</div>";

		return $ouput;
	}


	private function get_textarea( $field ) {

		// it's easier to work with an object in a string than with an array
		$field = (object)$field;

		return "<div class='input-wrapp two-columns'>
		<label class='textarea-label'>$field->label</label>
		<textarea id='$field->name' name='$field->name' class='$field->class'>$field->value</textarea>
		</div>";

	}

	
	private function get_input_field( $type, $label, $name, $validation, $field_class, $field_value, $hidden = "" ) {
		return "<div class='input-wrapp $hidden'>
			<label class='material-label'>$label</label>
			<input 
				type='$type'
				name='$name'
				$validation
				value='$field_value'
				class='$field_class'>
		</div>";
	}


	/**
	 * @return (string) - Name attribute that is going to be used for the provided field
	 */
	private function field_name( $field ) {

		// If section IS NOT of a type "repeater"
		if ( empty( $field['repeater_children'] ) )
			return $field['name'];


		$field_name = $field['repeater_children'] . '[' . $field['name'] . '][]';

		return $field_name;
	}


	/**
	 * Print validation attrubtes
	 */
	private function field_validation( $validation ) {

		$validation_html = "";

		foreach ($validation as $key => $value) {
			$validation_html .= $key . '="' . $value . '"';
		}

		return $validation_html;

	}

}