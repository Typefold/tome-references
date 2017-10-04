<?php
/**
* Is used to handle saving new Bibliographic Entry
*/
class Biblio_Entry
{
	
	protected $entry_data;
	public $entry_id, $entry_title;

	function __construct( $post_id = null )
	{
		$this->entry_id = $post_id;
	}

	public function create( array $data ) {
		$this->entry_data = $data;
		$this->set_entry_title();
		$post_id = $this->add_new_entry();
		$this->save_entry_meta();
	}

	public function update( array $data ) {
		$this->entry_data = $data;
		$this->set_entry_title();
		$this->save_entry_meta( $this->entry_id );

		return $this->entry_id;
	}

	private function set_entry_title() {

		if ( $this->entry_data['type-of-source'] == 'personal_interview' ) {
			unset( $this->entry_data['biblio_title'] );
			return $this->entry_data['interviewee'][0]['first_name'] . ' ' . $this->entry_data['interviewee'][0]['last_name'] . ' (Interview)';
		}

		# get name of the field, which is going to work as a title for biblio
		$title_field = $this->entry_data['biblio_title'];

		# retrieve value from the title_field
		$post_title = $this->entry_data[ $title_field ];

		unset( $this->entry_data['biblio_title'] );

		$this->entry_title = stripslashes( $post_title );
	}

	private function add_new_entry() {

		$my_post = array(
			'post_title'    => $this->entry_title,
			'post_status'   => 'publish',
			'post_author'   => get_current_user_id(),
			'post_type' => 'tome_bibliography',
		);

		// Insert the post into the database
		$this->entry_id = wp_insert_post( $my_post );
	}

	private function save_entry_meta() {

		$my_post = array (
			'ID' => $this->entry_id,
			'post_title' => $this->entry_title
		);

		wp_update_post( $my_post );

		foreach ($this->entry_data as $field_name => $field_value) {

			// don't save empty meta
			if ( empty($field_value) ) { continue; }

			update_post_meta( $this->entry_id, $field_name, $field_value );

		}
	}


}
