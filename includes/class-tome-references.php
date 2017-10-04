<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Tome_References
 * @subpackage Tome_References/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Tome_References
 * @subpackage Tome_References/includes
 * @author     Your Name <email@example.com>
 */
class Tome_References {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Tome_References_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $tome_references    The string used to uniquely identify this plugin.
	 */
	protected $tome_references;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->tome_references = 'tome-references';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Tome_References_Loader. Orchestrates the hooks of the plugin.
	 * - Tome_References_i18n. Defines internationalization functionality.
	 * - Tome_References_Admin. Defines all hooks for the admin area.
	 * - Tome_References_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tome-references-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tome-references-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/class-biblio-entries-admin-page.php';


		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-tome-references-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-tome-references-public.php';

		/**
		 * The class responsible for printing form fields for each bibliographic type / entry
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-biblio-fields.php';


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-biblio-form-data.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-biblio-entry.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-biblio-entry-printer.php';
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-biblio-entry-printer-mla.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-biblio-entry-printer-chicago.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-biblio-entry-printer-chicago-author-date.php';
		




if ( $_GET['source_fix'] == true ) {

	$chicago = require_once dirname(__FILE__) . '/chicago-fields-vertical.php';
	$mla = require_once dirname(__FILE__) . '/mla-fields-vertical.php';

	$sources = array();

	foreach ($chicago  as $key => $value) {
		$sources[] = $key;	
	}


	$posts = get_posts(array(
		'post_type' => 'tome_bibliography',
		'posts_per_page' => -1,
		'meta_key' => 'type-of-source',
		'meta_value' => $sources,
		'meta_compare' => 'NOT IN'
	));

	print_r( $posts );

	foreach ($posts as $biblio) {

	}
}








if ( $_GET['fix_title'] == true ) {


	$posts = get_posts(array(
		'post_type' => 'tome_bibliography',
		'posts_per_page' => -1
	));

	$chicago = require_once dirname(__FILE__) . '/chicago-fields-vertical.php';
	$mla = require_once dirname(__FILE__) . '/mla-fields-vertical.php';


	foreach ($posts as $biblio) {

		$meta = get_post_custom( $biblio->ID );
		$style = $meta['biblio-style'][0];
		$source = $meta['type-of-source'][0];

		switch ( $style ) {
			case 'chicago':
				$title_field = end( $chicago[ $source ][1]['fields'] );
				$title_field = $title_field['value'];
			break;

			case 'mla':
				$title_field = end( $mla[ $source ][1]['fields'] );
				$title_field = $title_field['value'];
			break;
			
			default:
			break;
		}

		add_post_meta( $biblio->ID, 'biblio_title', $title_field, true );
	}


}



		$this->loader = new Tome_References_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Tome_References_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Tome_References_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Tome_References_Admin( $this->get_tome_references(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'reference_modal_window' );
		$this->loader->add_action( 'wp_ajax_get_biblio_style_sources', $plugin_admin, 'get_biblio_style_sources' );
		$this->loader->add_action( 'wp_ajax_update_reference', $plugin_admin, 'update_reference' );
		$this->loader->add_action( 'wp_ajax_generate_reference_text', $plugin_admin, 'generate_reference_text' );
		$this->loader->add_action( 'wp_ajax_get_reference_text', $plugin_admin, 'get_reference_text' );
		$this->loader->add_action( 'wp_ajax_get_biblio_form_values', $plugin_admin, 'get_biblio_form_values' );
		$this->loader->add_action( 'wp_ajax_get_biblio_form', $plugin_admin, 'get_biblio_form' );
		$this->loader->add_action( 'wp_ajax_save_bibliography', $plugin_admin, 'save_bibliography' );
		$this->loader->add_action( 'wp_ajax_delete_bibliography', $plugin_admin, 'delete_bibliography' );
		$this->loader->add_action( 'wp_ajax_dynamic_field', $plugin_admin, 'dynamic_field' );
		$this->loader->add_action( 'wp_ajax_create_reference', $plugin_admin, 'create_reference' );
		$this->loader->add_action( 'wp_ajax_get_biblio_entry_meta', $plugin_admin, 'get_biblio_entry_meta' );
		$this->loader->add_action( 'wp_ajax_init_tinymce_fields', $plugin_admin, 'init_tinymce_fields' );
		$this->loader->add_filter( 'mce_external_plugins', $plugin_admin, 'add_tinymce_plugin' );
		$this->loader->add_filter( 'tiny_mce_before_init', $plugin_admin, 'references_tinymce_format' );


		$this->loader->add_action( 'before_delete_post', $plugin_admin, 'delete_references_in_post' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'delete_unused_references' );
		$this->loader->add_action( 'init', $plugin_admin, 'tome_reference_post_type', 0 );
		$this->loader->add_action( 'init', $plugin_admin, 'tome_bibliography_post_type', 0 );

		$this->loader->add_action('admin_menu', $plugin_admin, 'add_menu_items');

		add_shortcode( 'tome_reference', array( $this, 'tome_reference_shortcode' ) );
	}



	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Tome_References_Public( $this->get_tome_references(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_ajax_reference_tooltip', $plugin_public, 'reference_tooltip' );
		$this->loader->add_action( 'wp_ajax_nopriv_reference_tooltip', $plugin_public, 'reference_tooltip' );
		$this->loader->add_action( 'works-cited', $plugin_public, 'works_cited_content' );
		$this->loader->add_action( 'bibliography', $plugin_public, 'page_bibliography_list' );
	}


	public static function tome_reference_shortcode($atts, $content) {

		$reference_id = intval($atts['id']);
		$biblio_id = $atts['biblio-id'];
		$reference = get_post( $reference_id );		

		$output = '';
		$output .= '<span class="tome-tooltip has-tip" data-biblio=' . $biblio_id . '>';
		$output .= '<span>' . $content . '</span>';
		$output .= '<textarea class="reference-popup-content">' . esc_html( $reference->post_content ) . '</textarea>';
		$output .= '</span>';

		// $output .= "<span class='tome-tooltip has-tip' data-biblio='$biblio_id'>";
		// $output .= $content;
		// $output .= "<textarea class='hidden reference-popup-text'>" . $reference->post_content .  "</textarea>";
		// $output .= "</span>";



		return $output;
	}


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}


	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_tome_references() {
		return $this->tome_references;
	}


	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Tome_References_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}


	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

