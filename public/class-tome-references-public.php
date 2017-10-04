<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Tome_References
 * @subpackage Tome_References/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tome_References
 * @subpackage Tome_References/public
 * @author     Your Name <email@example.com>
 */
class Tome_References_Public {

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
	 * @param      string    $tome_references       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $tome_references, $version ) {

		$this->tome_references = $tome_references;
		$this->version = $version;

	}

	public function reference_tooltip() {

		$reference_id = $_GET['reference_id'];
		$biblio_id = $_GET['biblio_id'];

		$reference = get_post( $reference_id );

		$output = "<span class='content-wrapp'>$reference->post_content</span>";

		$output .= "<a href='#' class='view-biblio' data-biblio='$biblio_id'>View</a>";

		echo $output;

		die();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'tooltipster', plugin_dir_url( __FILE__ ) . 'css/tooltipster.bundle.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->tome_references, plugin_dir_url( __FILE__ ) . 'css/tome-references-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->tome_references, plugin_dir_url( __FILE__ ) . 'js/tooltipster.bundle.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'tooltip', plugin_dir_url( __FILE__ ) . 'js/tome-references-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( 'tooltip', 'frontendajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )) );
	}


	/**
	 * Prints out sorted list of bibliographic entries.
	 * @return string of HTML
	 */
	public function page_bibliography_list() {

		$biblio_entries = get_posts( array( 'post_type' => 'tome_bibliography', 'posts_per_page' => -1 ) );
		$biblio_entries = $this->sort_biblio_entries( $biblio_entries );

		foreach ($biblio_entries as $entry) {
			$output .= '<p class="biblio-entry">' . $entry['original_format'] . '</p>';
		}

		echo $output;
	}



	public function works_cited_content() {

		global $post;
		$output = "";
		$biblio_ids = $this->get_content_bibio_ids( $post );

		if ( empty( $biblio_ids ) ) 
			return;

		$biblio_entries = get_posts( array( 'post_type' => 'tome_bibliography', 'post__in' => $biblio_ids, 'posts_per_page' => -1 ) );
		$biblio_entries = $this->sort_biblio_entries( $biblio_entries );


		$output .= '<section class="works-cited">';
			$output .= '<p class="works-cited-title"><strong>Works Cited</strong></p>';

			foreach ($biblio_entries as $entry) {
				$output .= '<span class="biblio-entry" data-biblio="'.$entry['entry_id'].'">';
				$output .= $entry['original_format'];
				$output .= '</span>';
			}

		$output .= '</section>';

		echo $output;
	}


	/**
	 * Searches through post's content and looks for tome_reference shortcode
	 * and extract bibliographic ID
	 * @param  WP_Oject $post - post which is going to be searched
	 * @return array          - IDs of bibliographic entries
	 */
	private function get_content_bibio_ids( $post ) {

		$biblio_ids = array();

		preg_match_all( '/\[tome_reference id=["\'](\d+?)["\'].*?biblio-id=["\'](\d+?)["\']\]([^\[]*)\[\/tome_reference\]/', $post->post_content, $matches );

		foreach ($matches[2] as $bibli_id) {
			array_push($biblio_ids, $bibli_id);
		}

		return $biblio_ids;
	}


	/**
	 * Sorts array of bibliographic entries in ascending order
	 * and puts entries starting with the number at the end
	 * @param  array $biblio_entries - array of bibliographic entries (post_type: tome_bibliography)
	 * @return array - sorted array of bibliographic entries
	 */
	private function sort_biblio_entries( $posts ) {

		$biblio_entries = array();

		foreach( $posts as $key => $post ) {

			$original_entry = Biblio_Entry_Printer::print_entry( $post );

			$sorting_format = strip_tags( $original_entry );
			$sorting_format = strtolower( $sorting_format );

			// If the entry starts with a quote
			if ( $sorting_format[0] == '"' )
				$sorting_format[0] = $sorting_format[1];

			// If the entry starts with a number
			if ( is_numeric( $sorting_format[0] ) )
				$sorting_format[0] = 'zzzzzzzzzzzzz';

			$biblio_entries[$key]['sorting_format'] = $sorting_format;
			$biblio_entries[$key]['original_format'] = $original_entry;
			$biblio_entries[$key]['entry_id'] = $post->ID;
		}

		sort( $biblio_entries, SORT_REGULAR );

		return $biblio_entries;
	}



}
