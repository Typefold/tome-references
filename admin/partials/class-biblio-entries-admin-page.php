<?php

/**
* Is responsible for displaying bibliographic entries list
* in the admin under the page
*/
class Biblio_Entries_Admin_Page {

	public $all_posts; // All posts that containt at least one reference
	public $all_references;
	public $all_biblio;

	function __construct() {
		$this->all_references = $this->get_all_references();
		$this->all_biblio = $this->get_all_biblio();
	}


	private function reference_parent($reference, $parent_id) {
		return ($reference->post_parent == $parent_id);
	}

	private function the_biblio_reference( $reference, $parent_biblio ) {

		$parent = get_post( $reference->post_parent );
		$parent_url = get_edit_post_link($parent->ID);


		$output = "";
		$output .= "<a class='biblio-title'>$parent_biblio->post_title</a>";
		$output .= "<div class='biblio-reference' data-biblio-id='$biblio->ID' data-reference-id='$reference->ID'>";
		$output .= "<div class='reference-text'>$reference->post_content</div>";
		$output .= "<div class='reference-parent'><span>featured in</span> <a href='$parent_url'>$parent->post_title</a></div>";
		$output .= "</div>";

		echo $output;
	}

	public function print_admin_page() {
		?>

		<div class="biblio-admin-page" id="biblio-entries-list">
			<div class="wrap acf-settings-wrap">
				<h1>Bibliographic entries</h1>
			</div>

			<input type="text" class="search" name="search_bibliographies" id="biblio-search" placeholder="<?php _e('search', 'tome'); ?>" value="">

			<table class="biblio-entries-table">
				<thead>
					<tr>
						<th>Bibliographic entries</th>
						<th>References</th>
						<th>Style</th>
						<th>Craated at</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody class="list">
					<?php $this->print_biblio_entries(); ?>
				</tbody>
			</table>			

		</div>

		<?php
	}


	private function print_biblio_entries() {

		$i = 1;

		foreach ($this->all_biblio as $biblio) {

			$odd = ( $i % 2 == 0 ) ? "even" : "odd"; 
			$biblio_references = $this->get_biblios_references( $biblio->ID );
			$biblio_meta = get_post_custom( $biblio->ID );
			$biblio_style = $biblio_meta['biblio-style'][0];
			$references_count = count( $biblio_references );
			$i++;
			?>

			<tr class="biblio-entry <?php echo $odd; ?>" data-biblio-id="<?php echo $biblio->ID; ?>">
				<td class="entry-title-column column">
					<a href="#" class="biblio-title"><?php echo $biblio->post_title; ?></a>
				</td>
				<td class="references-count column"><?php echo $references_count . ' ' . __('reference', 'tome'); ?></td>
				<td class="biblio-style-column column"><?php echo $biblio_style; ?></td>
				<td class="created-at column">02/01/2017</td>
				<td class="action column">
					<a href="#edit" class="edit-biblio"><?php _e('edit', 'tome') ?></a>
					<a href="javascript:;" class="remove-biblio"><?php _e('delete', 'tome') ?></a>
				</td>
			</tr>

			<tr class="biblio-references-list">
				<td colspan="5">
					<?php
					foreach ($biblio_references as $reference) {
						$this->the_biblio_reference( $reference, $biblio );
					}
					?>
				</td>
			</tr>

			<?php

		}

	}


	/**
	 * Get all posts which containt at least one reference
	 * @return array of fallowing structure
	 * [
	 * 'post_id' => integer,
	 * 'post_references' => array(
	 * 		'reference_id' => integer,
	 * 		'biblio_id' => integer,
	 * )
	 * ]
	 */
	private function all_refs_posts() {

		$all_references = array();

		$ref_query = new WP_Query(array(
			'post_type' => array('post','page','chapter'),
			'posts_per_page' => -1
			));

		if ( $ref_query->have_posts() ) : while ( $ref_query->have_posts() ) : $ref_query->the_post();

		global $post;

		$post_references = array();
		$post_content = get_the_content();
		$pattern = '/\[tome_reference.*? id=["\'](\d*)["\'].*? biblio-id=["\'](\d*)["\']/';


		preg_match_all($pattern, $post_content, $matches);


		if ( count( $matches[0] ) == 0 )
			continue;


		for ( $i=0; $i < count( $matches[1] ); $i++ ) { 



			array_push( $post_references, array(
				'reference_id' => $matches[1][$i],
				'biblio_id' => $matches[2][$i]
				));
		}


		$all_references[] = array(
			'post_id' => $post->ID,
			'post_references' => $post_references
		);


		$this->all_posts[] = $post->ID;


		endwhile;
		else:
			echo 'no post found';
		endif;

		return $all_references;

	}




	private function get_all_references() {
		$args = array( 'post_type' => 'tome_reference', 'posts_per_page' => -1 );
		$posts = get_posts($args);

		return $posts;
	}



	private function get_all_biblio() {
		$args = array( 'post_type' => 'tome_bibliography', 'posts_per_page' => -1 );
		$posts = get_posts($args);

		return $posts;
	}



	// Retrieve all references of given biblio entry
	private function get_biblios_references( $biblio_id ) {
		$args = array(
			'post_type' => 'tome_reference',
			'meta_query' => array(
				array(
					'key' => 'reference_biblio',
					'value' => $biblio_id,
					'compare' => '='
				)
			)
		);
		return get_posts( $args );
	}

}