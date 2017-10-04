<?php
/**
* Is used to handle saving new Bibliographic Entry
*/
class Biblio_Entry_Printer_Chicago extends Biblio_Entry_Printer
{
	
	protected $biblio_entry, $entry_meta;

	function __construct( $biblio_entry ) {

		$this->biblio_entry = $biblio_entry;
		$this->entry_meta = get_post_custom( $biblio_entry->ID );

	}

	/**
	 * Get type-of-source meta value and based on its value
	 * use function from this class to print the bibliographic entry
	 */
	public function get_formated_biblio() {

		$entry_meta = $this->entry_meta;

		/**
		 * Each biblio type has it's own print function in this class
		 * so we are calling the function dynamically instead of writing
		 * "switch & case" for each function
		 */
		$function_name = $entry_meta['type-of-source'][0];


		if ( $this->is_valid_function( $this, $function_name ) == false )
			return '';


		switch ( $function_name ) {
			case 'ebook':
				$biblio_entry = $this->book();
				break;
			
			default:
				$biblio_entry = $this->$function_name();
				break;
		}


		return $biblio_entry;
	}


	/**
	 * Print style for "book" biliographic entry
	 * @param  string $ending - the string which should be on the end of the output eg. (Print. Web. etc.)
	 */
	private function book() {

		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$editors = $entry_meta['editor'];
		$translators = $entry_meta['translator'];
		$book_title = '<i>' . $entry_meta['book_title'][0] . '. </i> ';
		$place_of_publication = $entry_meta['place_of_publication'][0] . ': ';
		$publisher = $entry_meta['publisher'][0] . '. ';
		$year_of_publication = $entry_meta['year_of_publication'][0] . '.';


		$output = '';

		$output .= $this->format_people( $authors, true );

		if ( empty( $authors ) ) {
			$output .= $this->format_people( $editors, false, '', '' );
			$output .= $this->format_people( $translators, false, 'trans.', 'trans.' );
		}


		$output .= $book_title;

		if ( ! empty( $authors ) ) {
			$output .= $this->format_people( $editors, false, 'ed.', 'eds.' );
			$output .= $this->format_people( $translators, false, 'trans.', 'trans.' );
		}

		$output .= $place_of_publication . $publisher . $year_of_publication;


		return $output;
	}

	private function chapter_or_other_part_of_a_book () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$editors = $entry_meta['editor'];
		$translators_collection = $entry_meta['translator_collection'];
		$translators_essay = $entry_meta['translator_essay'];
		$essay_title = '"' . $entry_meta['essay_title'][0] . '" ';
		$book_title = '<i>' . $entry_meta['book_title'][0] . ', </i> ';
		$page_range = $entry_meta['page_range'][0] . '. ';
		$place_of_publication = $entry_meta['place_of_publication'][0] . ': ';
		$publisher = $entry_meta['publisher'][0] . ', ';
		$year_of_publication = $entry_meta['year_of_publication'][0] . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		if ( empty( $authors ) ) {
			$output .= $this->format_people( $editors, false, '', '' );
			$output .= $this->format_people( $translators, false, 'trans.', 'trans.' );
		}

		$output .= $essay_title . $book_title;

		if ( ! empty( $authors ) ) {
			$output .= $this->format_people( $editors, false, 'ed.', 'eds.' );
			$output .= $this->format_people( $translators, false, 'trans.', 'trans.' );
		}


		$output .= $page_range . $place_of_publication . $publisher . $year_of_publication;

		return $output;
	}

	private function preface_foreword_introduction_or_similar_part_of_a_book () {
		$entry_meta = $this->entry_meta;

		$introduction_author = $entry_meta['author'];
		$book_authors = $entry_meta['book_author'];
		$editors = $entry_meta['editor'];
		$translators = $entry_meta['translator'];
		$section_type = $entry_meta['section_type'][0] . ' ';
		$section_title = '"' . $entry_meta['section_title'][0] . '". ';
		$book_title = '<i>' . $entry_meta['book_title'][0] . ', </i>';
		$page_range = $entry_meta['page_range'][0] . '. ';
		$place_of_publication = $entry_meta['place_of_publication'][0] . ': ';
		$publisher = $entry_meta['publisher'][0] . ', ';
		$year_of_publication = $entry_meta['year_of_publication'][0] . '.';

		$output = '';

		$output .= $this->format_people( $introduction_author, true );

		$output .= $section_title . $section_type . $book_title;

			$output .= $this->format_people( $book_authors, false, 'by', 'by' );
			$output .= $this->format_people( $editors, false, 'edited by', 'edited by' );
			$output .= $this->format_people( $translators, false, 'translated by', 'translated by' );

		$output .= $page_range . $place_of_publication . $publisher . $year_of_publication;


		return $output;
	}

	private function chapter_of_an_edited_volume_originally_published_elsewhere() {

		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$editors = $entry_meta['editor'];
		$translators = $entry_meta['translator'];
		$primary_source_title = '"' . $entry_meta['primary_source_title'][0] . '." ';
		$edited_volume_title = 'In <i>' . $entry_meta['edited_volume_title'][0] . ', </i> ';
		$page_range = $entry_meta['page_range'][0] . '. ';
		$publisher = $entry_meta['publisher'][0] . ': ';
		$place_of_publication = $entry_meta['place_of_publication'][0] . ', ';
		$year_of_publication = $entry_meta['year_of_publication'][0] . '. ';
		$originally_published_in = $entry_meta['originally_published_in'][0] . '.';

		$output = "";

		$output .= $authors . $primary_source_title;

		$output .= $this->format_people( $editors, false, 'edited by', 'edited by' );

		$output .= $this->format_people( $translators, false, 'translated by', 'translated by' );

		$output .= $page_range  . $place_of_publication . $publisher . $place_of_publication . $year_of_publication . $originally_published_in;
	}

	private function ebook () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$editors = $entry_meta['editor'];
		$translators = $entry_meta['translator'];
		$year_of_publication = $entry_meta['year_of_publication'][0] . '. ';
		$book_title = '<i>' . $entry_meta['book_title'][0] . '. </i> ';
		$place_of_publication = $entry_meta['place_of_publication'][0] . ': ';
		$publisher = $entry_meta['publisher'][0] . '. ';
		$url = $entry_meta['url'][0] . '.';


		$output = '';

		$output .= $this->format_people( $authors, true );
		$output .= $this->format_people( $editors, false, 'eds.', 'eds.' );

		$output .= $book_title;

		$output .= $this->format_people( $translators, false, 'trans.', 'trans.' );

		$output .= $place_of_publication . $publisher . $year_of_publication . $url;


		return $output;
	}

	private function chapter_or_part_of_an_ebook () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$editors = $entry_meta['editor'];
		$translators_collection = $entry_meta['translator_collection'];
		$translators_essay = $entry_meta['translator_essay'];
		$year_of_publication = $entry_meta['year_of_publication'][0] . '. ';
		$essay_title = '"' . $entry_meta['essay_title'][0] . '" ';
		$book_title = '<i>' . $entry_meta['book_title'][0] . ', </i> ';
		$page_range = $entry_meta['page_range'][0] . '. ';
		$place_of_publication = $entry_meta['place_of_publication'][0] . ': ';
		$publisher = $entry_meta['publisher'][0] . '. ';
		$url = $entry_meta['url'][0] . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $essay_title . $book_title;

		$output .= $this->format_people( $editors, false, 'Edited by', 'Edited by' );

		$output .= $this->format_people( $translators_collection, false, 'Translated by', 'Translated by' );

		$output .= $page_range. $place_of_publication . $publisher . $year_of_publication . $url;

		return $output;
	}

	private function preface_or_foreword_to_an_ebook () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$book_authors = $entry_meta['book_author'];
		$editors = $entry_meta['editor'];
		$translators = $entry_meta['translator'];
		$essay_type = $entry_meta['essay_type'][0] . ' ';
		$book_title = '<i>' . $entry_meta['book_title'][0] . '. </i>';
		$page_range = $entry_meta['page_range'][0] . '. ';
		$place_of_publication = $entry_meta['place_of_publication'][0] . ': ';
		$publisher = $entry_meta['publisher'][0] . '. ';
		$year_of_publication = $entry_meta['year_of_publication'][0] . '.';
		$url = $entry_meta['url'][0] . '.';

		$output = '';

		$output .= $this->format_people( $authors, true );

		$output .= $essay_title . $book_title;

		$output .= $this->format_people( $book_authors, false, 'by', 'by' );
		$output .= $this->format_people( $editors, false, 'Edited by', 'Edited by' );
		$output .= $this->format_people( $translators, false, 'Translated by', 'Translated by' );


		$output .= $page_range . $place_of_publication . $publisher . $year_of_publication . $url;


		return $output;
	}

	private function article_in_a_print_journal () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$article_title = '"' . $entry_meta['article_title'][0] . '." ';
		$journal_title = '<i>' . $entry_meta['journal_title'][0] . ' </i>';
		$volume = $entry_meta['volume'][0] . ' ';
		$issue = "no. " . $entry_meta['issue'][0] . ' ';
		$year = "(" . $entry_meta['year'][0] . '): ';
		$page_range = $entry_meta['page_range'][0] . '.';


		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $article_title . $journal_title . $volume . $issue . $year . $page_range;

		return $output;
	}

	private function article_in_a_online_journal () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$translators = $entry_meta['translator'];
		$article_title = '"' . $entry_meta['article_title'][0] . '." ';
		$journal_title = '<i>' . $entry_meta['journal_title'][0] . ' </i>';
		$volume = $entry_meta['volume'][0] . ' ';
		$issue = "no. " . $entry_meta['issue'][0] . '. ';
		$year = "(" . $entry_meta['year'][0] . '): ';
		$date_accessed = "Accessed " . date( 'F j', $entry_meta['date_accessed'][0] ) . '. ';
		$dynamic_field = $entry_meta['dynamic_field'][0] . '.';


		$output = "";

		$output .= $this->format_people( $authors, true );

		// TODO: add url or doi field 
		$output .= $article_title . $journal_title . $volume . $issue . $year . $page_range . $date_accessed . $dynamic_field;

		return $output;
	}

	private function article_in_a_print_newspaper_or_magazine () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$year = $entry_meta['year'][0] . '. ';
		$article_title = '"' . $entry_meta['article_title'][0] . '." ';
		$periodical_title = '<i>' . $entry_meta['periodical_title'][0] . ', </i>';
		$date = date( 'F j', $entry_meta['date'][0] ) . '.';


		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $article_title . $periodical_title . $date;

		return $output;
	}

	private function article_in_a_newspaper_or_magazine_accessed_online () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$year = $entry_meta['year'][0] . '. ';
		$article_title = '"' . $entry_meta['article_title'][0] . '." ';
		$periodical_title = '<i>' . $entry_meta['periodical_title'][0] . ', </i>';
		$date = date( 'F j', $entry_meta['date'][0] ) . '. ';
		$date_accessed = "Accessed " . date( 'F j', $entry_meta['date_accessed'][0] ) . '. ';
		$url = $entry_meta['url'][0] . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $article_title . $periodical_title . $date . $date_accessed . $url;

		return $output;
	}

	private function thesis_or_disertation() {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$thesis_title = '"' . $entry_meta['thesis_title'][0] . '." ';
		$thesis_type = $entry_meta['thesis_type'][0] . "., ";
		$university = $entry_meta['university'][0] . ", ";
		$year = $entry_meta['year'][0] . ".";


		$output = "";

		$output .= $this->format_people( $authors, true );

		// TODO: add url or doi field 
		$output .= $thesis_title . $thesis_type . $university . $year;

		return $output;
	}



	private function website () {
		$entry_meta = $this->entry_meta;

		$website_title = $entry_meta['website_title'][0] . '. ';
		$page_title = '"' . $entry_meta['page_title'][0] . '." ';
		$date_accessed = 'Accessed ' . date( 'F j, Y', $entry_meta['date_accessed'][0] ) . '. ';
		$url = $entry_meta['url'][0] . '.';

		$output = "";

		$output .= $website_title . $page_title . $date_accessed . $url;

		return $output;
	}

	private function paper_presented_at_a_meeting_or_conference () {
		$entry_meta = $this->entry_meta;

		$presenters = $entry_meta['presenter'];
		$presentation_title = '"' . $entry_meta['presentation_title'][0] . '." ';
		$presentation_type = $entry_meta['presentation_type'][0] . ', ';
		$place_of_presentation = $entry_meta['place_of_presentation'][0] . ', ';
		$date = date( 'F j', $entry_meta['date'][0] ) . '.';

		$output = "";

		$output .= $this->format_people( $presenters, true );

		$output .= $presentation_title . $presentation_type . $place_of_presentation . $date;

		return $output;
	}



}
	