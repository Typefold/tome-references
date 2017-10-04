<?php
class Biblio_Entry_Printer
{
	
	protected $entry_meta;


	public static function print_entry( $entry ) {

		$entry_meta = get_post_custom( $entry->ID );

		switch ( $entry_meta['biblio-style'][0] ) {
			case 'chicago':

				$chicago_system = $entry_meta['chicago-system'][0];

				if ( $chicago_system == 'author-date' )
					$biblio_entry = new Biblio_Entry_Printer_Chicago_Author_Date( $entry );
				else
					$biblio_entry = new Biblio_Entry_Printer_Chicago( $entry );

			break;

			case 'mla':
				$biblio_entry = new Biblio_Entry_Printer_Mla( $entry );
			break;

			case 'custom':
				return $entry_meta['biblio_text'][0];
			break;
			
			default:
				echo $entry->ID;
				die();
			break;
		}


		return $biblio_entry->get_formated_biblio();
	}


	private function format_people_data( $people ) {

		$formated_data = array();

		for ( $i = 0; $i < count( $people['first_name'] ); $i++ ) {
			$formated_data[] = array(
				'first_name' => $people['first_name'][$i],
				'middle_name' => $people['middle_name'][$i],
				'last_name' => $people['last_name'][$i],
			);
		}


		return $formated_data;

	}


	public function format_people( $people, $reversed_name, $single_prefix = "", $multiple_prefix = "" ) {

		$people = unserialize( $people[0] );
		$people = $this->format_people_data( $people );

		if (  count( $people ) == 0 )
			return;


		if ( count( $people ) == 1 ) {
			return $this->single_person( $people, $reversed_name, $single_prefix );
		}

		return $this->multiple_people( $people, $reversed_name, $multiple_prefix );
	}


	/**
	 * Prints people in correct format
	 * @param  string $people        - Unserialized array of people
	 * @param  boolean $reversed_name - do we want THE FIRST NAME to be in a reversed order eg. Kohout, Jakub
	 * @return string
	 */
	private function multiple_people( $people, $reversed_name, $multiple_prefix = "" ) {

		if ( !empty( $multiple_prefix ) )
			$output .= $multiple_prefix . ' ';


		// $reversed_name = ( is_a( $this, 'Biblio_Entry_Printer_Chicago' ) ) ? true : $reversed_name;


		// if we have multiple authors loop through them
		foreach ( $people as $key => $person ) {

			if ( $key == 0 ) {

				$name = $this->single_person( $people, $reversed_name );

				// Single person has "." on the end of the string and here we wnat dash
				$output .= substr($name, 0, -2) . ', ';

			} elseif ( $key == 1 ) {

				$output .= 'and ' . $person['first_name'] . $person['middle_name'] . ' ' . $person['last_name'] . '. ';

			} else {

				$output .= $person['first_name'] . $person['middle_name'] . ' ' . $person['last_name'] . ', ';

			}

		} // End of foreach for $authors

		return $output;
	}


	/**
	 * @param  array $people          - Already serialized array that looks like this array('first_name' => '..', 'last_name' => '...')
	 * @param  boolean $reversed_name - do we want THE FIRST NAME to be in a reversed order eg. Kohout, Jakub
	 * @param  string $prefix         - Do this person has any prefix eg. (Ed. Tran. Dir.) etc...
	 * @return string 
	 */
	private function single_person( $people, $reversed_name, $prefix = "" ) {

		$prefix = ( !empty( $prefix ) ) ? $prefix . ' ' : "";

		$middle_name = $people[0]['middle_name'];

		# if we have middle name add space
		$middle_name = ( ! empty( $middle_name ) ) ? ' '. $middle_name : '';

		if ( $reversed_name == true ) {
			$output = $prefix . $people[0]['last_name'] . ', ' . $people[0]['first_name'] . $middle_name . '. ';
			return str_replace('..', '.', $output);
		}

		return $prefix . $people[0]['first_name'] . $middle_name . ' ' . $people[0]['last_name'] . '. ';
	}


	/**
	 * Each biblio entry has different way how to set up Author's name
	 */
	public static function get_author_name( $entry_meta = null ) {

		if ( ! isset( $entry_meta['author'] ) )
			return 'No Author';

		$biblio_type = $entry_meta['type-of-source'];

		switch ( $biblio_type ) {
			case 'presenter':
				$author = self::format_author_name( $entry_meta['presenter'] );
			break;
			
			default:
				$author = self::format_author_name( $entry_meta['author'] );
			break;
		}

		return $author;
	}


	private function format_author_name( $author_info ) {

		if ( empty( $author_info ) )
			return "--";

		$output = "";


		if ( isset( $author_info[0] ) )
			$author_info = unserialize($author_info[0]);



		foreach ($author_info['first_name'] as $key => $first_name) {
			$output .= $author_info['first_name'][$key] . ' ' . $author_info['middle_name'][$key] . ' ' . $author_info['last_name'][$key] . ', ';
		}



 		return substr($output, 0, -2);
	}


	public function is_valid_function( $checked_class, $function_name ) {
		return method_exists( $checked_class, $function_name );
	}


}
	