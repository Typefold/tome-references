<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Tome_References
 * @subpackage Tome_References/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tome_References
 * @subpackage Tome_References/admin
 * @author     Your Name <email@example.com>
 */
class Tome_References_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $tome_references    The ID of this plugin.
	 */
	private $tome_references;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $tome_references       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $tome_references, $version ) {

		$this->biblio_entries_admin_page = new Biblio_Entries_Admin_Page;
		$this->tome_references = $tome_references;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		global $pagenow, $post_type;

		// if ( $pagenow != 'post.php' && $pagenow != 'post-new.php' )
		// 	return;


		wp_enqueue_style( $this->tome_references, plugin_dir_url( __FILE__ ) . 'dist/tome-references.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'animatecss', plugin_dir_url( __FILE__ ) . 'lib/plugins/animate.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'scrollbar', plugin_dir_url( __FILE__ ) . 'lib/plugins/perfect-scrollbar.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		global $pagenow, $post_type;

		// if ( $pagenow != 'post.php' && $pagenow != 'post-new.php' )
		// 	return;


		wp_enqueue_script( 'jquery-ui-datepicker');
		wp_enqueue_script( 'scrollbar', plugin_dir_url( __FILE__ ) . 'lib/plugins/perfect-scrollbar.jquery.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'listjs', plugin_dir_url( __FILE__ ) . 'lib/plugins/list.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->tome_references, plugin_dir_url( __FILE__ ) . 'dist/tome-references.js', array( 'jquery', 'scrollbar' ), $this->version, false );
	}


	public function references_tinymce_format( $in ) {

		if ( $in['selector'] !== '#reference_text' )
			return $in;

		$in['toolbar1'] = 'bold,italic,underline,link,unlink';
		$in['toolbar2'] = '';
		return $in;		
	}


	function get_reference_text() {
		$reference_id = intval( $_GET['reference_id'] );

		$reference = get_post( $reference_id );
		
		echo $reference->post_content;

		die();
	}


	/**
	 * Tome - References tinymce plugin
	 */
	public function add_tinymce_plugin($plugin_array) {

		$plugin_array['tomeReferencesPlugin'] = plugin_dir_url( __FILE__ ) . 'dist/references-plugin-helper.js';
		return $plugin_array;
	}


	public function dynamic_field() {

		$field_name = $_POST['field_name'];

		$output = '';

		switch ( $field_name ) {
			case 'url':
				$output .= '<input type="text" name="url" required="required" value="" class="biblio-input ">';
			break;

			case 'doi':
				$output .= '<input type="text" name="doi" required="required" value="" class="biblio-input ">';
			break;
			
			default:
			break;
		}


		echo $output;

		die();

	}

	public function reference_modal_window() {

		global $pagenow, $post_type;

		// if ( $pagenow != 'post.php' && $pagenow != 'post-new.php' )
		// 	return;

		?>

		<div class="md-modal md-effect-1" id="references-modal">
			<div class="md-content">

				<a href="javascript:;" class="close-references-modal">Close</a>

				<?php
				$biblio = get_posts( array(
					"post_type" => "tome_bibliography",
					"posts_per_page" => -1,
					) );
				
					$active_section = ( empty( $biblio ) ) ? " active" : " hidden";
					
					include plugin_dir_path( dirname( __FILE__ ) ) . 'includes/partials/no-biblio-entries.php';
					
					$active_section = ( empty( $biblio ) ) ? " hidden" : " active";

					include plugin_dir_path( dirname( __FILE__ ) ) . 'includes/partials/biblio-list.php';
					include plugin_dir_path( dirname( __FILE__ ) ) . 'includes/partials/biblio-form.php';
					include plugin_dir_path( dirname( __FILE__ ) ) . 'includes/partials/reference-form.php';

				?>

			</div>
		</div>
		<div class="md-overlay"></div>

		<?
	}


	public function save_bibliography() {

		parse_str( $_POST['form_data'], $data );
		$post_id = ( isset( $_POST['post_id'] ) ) ? $_POST['post_id'] : "";


		// new entry
		if ( empty( $post_id ) ) {

			$biblio_entry = new Biblio_Entry();
			$biblio_entry->create( $data );

		} else {

			$biblio_entry = new Biblio_Entry( $post_id );
			$biblio_entry->update( $data );

		}


		$output = array(
			'post_title' => $biblio_entry->entry_title,
			'post_id' => $biblio_entry->entry_id,
			'entry_author' => Biblio_Entry_Printer::get_author_name( $data ),
			'type_of_source' => $data['type-of-source'],
			'biblio_style' => $data['biblio-style']
		);

		echo json_encode( $output );

		die();
	}


	function create_reference() {
		$user_id = get_current_user_id();
		$biblio_id = $_POST['bibliography_id'];
		$content = $_POST['reference_text'];
		$post_parent = $_POST['post_parent'];

		$reference_post = array(
			'post_title'    => '',
			'post_content'  => $content,
			'post_status'   => 'publish',
			'post_author'   => $user_id,
			'post_type'		=> 'tome_reference',
			'post_parent'   => $post_parent,
			'meta_input'	=> array(
				'reference_biblio' => $biblio_id
			)
		);

		$reference = wp_insert_post( $reference_post );

		echo $reference;

		die();
	}


	function delete_bibliography () {
		$post_id = $_POST['id'];

		$this->delete_biblio_references( $post_id );

		wp_delete_post( $post_id );
	}

	/**
	 * Removes reference shortcodes from the post content
	 * @param  array $references_ids   array of references which are going to be deleted
	 * @param  array $references_posts posts with references
	 * @return void
	 */
	function remove_reference_shortcode_from_post_content( $references_ids, $post_reference_relationship ) {

		foreach ($post_reference_relationship as $post_id => $post_references) {

			$post = get_post( $post_id );
			$cleared_content = $post->post_content;

			foreach ($post_references as $reference_id) {
				$pattern = '/\[tome_reference id=["\']'.$reference_id.'["\'].*?\]([^\[]*?)\[\/tome_reference\]/';
				$replacement = '${1}';

				// find and remove [tome_reference] shortcode, but keep the content of it
				$cleared_content = preg_replace($pattern, $replacement, $cleared_content);
			}


			$post_arr = array(
				'ID' => $post->ID,
				'post_content' => $cleared_content
			);

			wp_update_post( $post_arr );

		}
	}

	/**
	 * Deletes all references associated with a bibliographic entry
	 * @param  integer $biblio_id biliographic entry ID
	 * @return void
	 */
	function delete_biblio_references( $biblio_id ) {

		/**
		 * Query for all references related to the bibliographic entry that we are deleting
		 */
		$args = array(
			'post_type' => 'tome_reference',
			'posts_per_page' => '-1',
			'meta_query' => array(
				array(
					'key' => 'reference_biblio',
					'value' => $biblio_id,
					'compare' => '='
				),
			)
		);

		$biblio_references = get_posts( $args );
		// ids of references which will be deleted
		$references_ids = wp_list_pluck( $biblio_references, 'ID' );
		// posts in which are references which should be deleted
		$posts_with_references = wp_list_pluck( $biblio_references, 'post_parent' );


		// Here we put together posts and references which they contains
		$post_reference_relationship = array();

		foreach ($biblio_references as $reference) {
			$post_reference_relationship[ $reference->post_parent ][] = $reference->ID;
		}


		$this->remove_reference_shortcode_from_post_content( $references_ids, $post_reference_relationship );

		foreach ($references_ids as $ref_id) {
			wp_delete_post( $ref_id );
		}

	}


	function generate_reference_text() {
		$biblio_id = $_POST['biblio_id'];
		$entry = get_post( $biblio_id );

		echo Biblio_Entry_Printer::print_entry( $entry );

		die();
	}


	public function get_biblio_entry_meta() {

		$biblio_meta = json_encode( get_post_custom( $_GET['biblio_id'] ) );

		echo $biblio_meta;

		die();
	}

	/**
	 * Loads the HTML for bibliography form
	 */
	public function get_biblio_form() {

		$biblio_id = $_GET['biblio_id'];
		$biblio_style = $_GET['biblio_style'];
		$type_of_source = $_GET['type_of_source'];
		$chicago_system = $_GET['chicago_system'];

		$fields_builder = new Biblio_Fields( $biblio_style, $type_of_source, $biblio_id );

		echo $fields_builder->print_form();

		die();
	}


	function get_biblio_form_values() {

		$biblio_entry_id = $_GET['biblio_id'];
		$entry_meta = get_post_custom( $biblio_entry_id );

		$form_values = array_map(
			function( $meta ) {
				$serialized = unserialize( $meta[0] );
				return ( $serialized === false ) ? $meta[0] : $serialized;
			},
			$entry_meta
		);

		echo json_encode( $form_values );

		die();
	}


	function update_reference() {
		$reference_id = $_POST['reference_id'];
		$reference_text = $_POST['reference_text'];

		$post_args = array(
			'ID'           => $reference_id,
			'post_title'   => '',
			'post_content' => $reference_text,
		);

		$updated_post = wp_update_post( $post_args );

		echo $updated_post;

		die();
	}


	/*
	* Delete refences associated with the post
	*/
	function delete_references_in_post( $post_id ) {

		$post = get_post( $post_id );

		preg_match_all( '/\[tome_reference id=[\'"](\d+)["\'].*\]([\s\S]*?)\[\/tome_reference\]/', $post->post_content, $matches);

		foreach ($matches[1] as $ref_id) {
			wp_delete_post( $ref_id );
		}
	}


	/**
	 * When saving post go through the content and find references
	 * which are ponting to a non-existing Biblio entires and delete them
	 * @param  integer $post_id
	 */
	function delete_unused_references( $post_id ) {

		$post = get_post($post_id);

		// references in database
		$args = array(
			'post_type' => 'tome_reference',
			'post_parent' => $post_id,
			'posts_per_page' => -1
		);

		$references = get_posts( $args );
		$ids = wp_list_pluck( $references, 'ID' );

		preg_match_all( '/\[tome_reference id=["\'](\d+?)["\'].*?\]([^\[]*)\[\/tome_reference\]/', $post->post_content, $matches);

		$deleted_references = array_diff($ids, $matches[1]);

		// $matches = preg_replace($pattern, $replacement, $subject);
		foreach ($deleted_references as $reference_id) {
			wp_delete_post( $reference_id );
		}
	}


	// Register Custom Post Type
	function tome_reference_post_type() {

		$labels = array(
			'name'                => _x( 'References', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Reference', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Reference', 'text_domain' ),
			'parent_item_colon'   => __( 'Parent Reference:', 'text_domain' ),
			'all_items'           => __( 'My References', 'text_domain' ),
			'view_item'           => __( 'View Reference', 'text_domain' ),
			'add_new_item'        => __( 'Add New Reference', 'text_domain' ),
			'add_new'             => __( 'New Reference', 'text_domain' ),
			'edit_item'           => __( 'Edit Reference', 'text_domain' ),
			'update_item'         => __( 'Update Reference', 'text_domain' ),
			'search_items'        => __( 'Search references', 'text_domain' ),
			'not_found'           => __( 'No references found', 'text_domain' ),
			'not_found_in_trash'  => __( 'No references found in Trash', 'text_domain' ),
		);
		$args = array(
			'label'               => __( 'reference', 'text_domain' ),
			'description'         => __( 'References', 'text_domain' ),
			'labels'              => $labels,
			'supports' 			  => array('title','revisions'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => 'edit.php?post_type=tome_bibliography',
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => false,
	        'menu_position'       => 13,
			'menu_icon' => 'dashicons-megaphone', 
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'tome_reference', $args );
	}


	function tome_bibliography_post_type() {

	    $labels = array(
	        'name'                => _x( 'Bibliographic Entries', 'Post Type General Name', 'text_domain' ),
	        'singular_name'       => _x( 'Bibliographic Entry', 'Post Type Singular Name', 'text_domain' ),
	        'menu_name'           => __( 'Bibliography', 'text_domain' ),
	        'parent_item_colon'   => __( 'Parent Bibliography:', 'text_domain' ),
	        'all_items'           => __( 'All Bibliographic Entries', 'text_domain' ),
	        'view_item'           => __( 'View Bibliographic Entry', 'text_domain' ),
	        'add_new_item'        => __( 'Add Bibliographic Entry', 'text_domain' ),
	        'add_new'             => __( 'New Bibliographic Entry', 'text_domain' ),
	        'edit_item'           => __( 'Edit Bibliographic Entry', 'text_domain' ),
	        'update_item'         => __( 'Update Bibliographic Entry', 'text_domain' ),
	        'search_items'        => __( 'Search Bibliographic Entry', 'text_domain' ),
	        'not_found'           => __( 'No bibliographic entries found', 'text_domain' ),
	        'not_found_in_trash'  => __( 'No bibliographic entries found in Trash', 'text_domain' ),
	    );
	    $args = array(
	        'label'               => __( 'Bibliographic Entries', 'text_domain' ),
	        'description'         => __( 'Bibliographic Entries', 'text_domain' ),
	        'labels'              => $labels,
	        'supports' 			  => array('title','revisions'),
	        'hierarchical'        => false,
	        'public'              => true,
	        'show_ui'             => true,
	        'show_in_menu'        => false,
	        'show_in_nav_menus'   => false,
	        'show_in_admin_bar'   => false,
	        'menu_position'       => 13,
	        'can_export'          => true,
	        'has_archive'         => true,
	        'exclude_from_search' => false,
	        'publicly_queryable'  => true,
	        'capability_type'     => 'post',
	    );
	    register_post_type( 'tome_bibliography', $args );
	}


	/**
	 * When biblio style eg. (mla, chicago) is changed
	 * retrieve it's sources eg. (book, ebook, chapter_or_part_of_an_ebook)
	 * @return string
	 */
	function get_biblio_style_sources() {

		$biblio_style = $_POST['biblio_style'];

		# array of selectbox options and their values
		$select_options = array();

		switch ( $biblio_style ) {
			case 'mla':
				$select_options = BiblioFormData::$mla_sources;
			break;
			case 'chicago':
				$select_options = BiblioFormData::$chicago_sources;
			break;
			case 'custom':
				$select_options = BiblioFormData::$custom_sources;
			break;
		}

		# string of all options elements eg. <option value='book'>book</option>
		$output = BiblioFormData::print_option_tags( $select_options );

		echo $output;

		die();
	}


	function init_tinymce_fields() {

		$tinymce_wrappers = $_GET['tinymce_wrappers'];

		$settings = array(
			'media_buttons' => false,
			'toolbar1' => 'bold,italic,undelrine,link,unlink'
		);

		foreach ($tinymce_wrappers as $wrapper) {
			wp_editor( $wrapper['wrapper_id'], $wrapper['wrapper_value'], $settings );
		}


		die();
	}


	function add_menu_items() {
		add_submenu_page( 'tome-writing', 'My Sub Level Menu Example', 'Bibliographic entries', 'edit_posts', 'biblio-list', array($this->biblio_entries_admin_page, 'print_admin_page') );
	}

		// 	$pattern = '/\[tome_reference.*? id=["\'](\d*)["\'].*? biblio-id=["\'](\d*)["\']/';
		// preg_match_all($pattern, $content, $matches);

}
	