<?php
/**
* Is used to handle saving new Bibliographic Entry
*/
class Biblio_Entry_Printer_Chicago_Author_Date extends Biblio_Entry_Printer
{
	
	protected $biblio_entry, $entry_meta;

	function __construct( $biblio_entry )
	{
		$this->biblio_entry = $biblio_entry;
		$this->entry_meta = get_post_custom( $biblio_entry->ID );
	}

	/**
	 * Prints bibliographic entry
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
		$year_of_publication = $entry_meta['year_of_publication'][0] . '. ';
		$book_title = '<i>' . $entry_meta['book_title'][0] . '. </i> ';
		$place_of_publication = $entry_meta['place_of_publication'][0] . ': ';
		$publisher = $entry_meta['publisher'][0] . '.';


		$output = '';

		$output .= $this->format_people( $authors, true );

		$output .= $year_of_publication. $book_title;

		$output .= $this->format_people( $editors, false, 'Edited by', 'Edited by' );
		$output .= $this->format_people( $translators, false, 'Translated by', 'Translated by' );

		$output .= $place_of_publication . $publisher;


		return $output;
	}

	private function chapter_or_other_part_of_a_book () {
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
		$publisher = $entry_meta['publisher'][0] . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $year_of_publication . $essay_title . $book_title;

		$output .= $this->format_people( $editors, false, 'Edited by', 'Edited by' );

		$output .= $this->format_people( $translators_collection, false, 'Translated by', 'Translated by' );

		$output .= $page_range. $place_of_publication . $publisher;

		return $output;
	}

	private function preface_foreword_introduction_or_similar_part_of_a_book () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$book_authors = $entry_meta['book_author'];
		$editors = $entry_meta['editor'];
		$translators = $entry_meta['translator'];
		$year_of_publication = $entry_meta['year_of_publication'][0] . '. ';
		$essay_type = $entry_meta['essay_type'][0] . ' ';
		$book_title = '<i>' . $entry_meta['book_title'][0] . ', </i>';
		$place_of_publication = $entry_meta['place_of_publication'][0] . ': ';
		$publisher = $entry_meta['publisher'][0] . '. ';
		$page_range = $entry_meta['page_range'][0] . '.';

		$output = '';

		$output .= $this->format_people( $authors, true );

		$output .= $year_of_publication . $essay_title . $book_title;

		$output .= $this->format_people( $book_authors, false, 'by', 'by' );
		$output .= $this->format_people( $editors, false, 'Edited by', 'Edited by' );
		$output .= $this->format_people( $translators, false, 'Translated by', 'Translated by' );


		$output .= $place_of_publication . $publisher . $page_range;


		return $output;
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

		$output .= $year_of_publication. $book_title;

		$output .= $this->format_people( $editors, false, 'Edited by', 'Edited by' );
		$output .= $this->format_people( $translators, false, 'Translated by', 'Translated by' );

		$output .= $place_of_publication . $publisher . $url;


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

		$output .= $year_of_publication . $essay_title . $book_title;

		$output .= $this->format_people( $editors, false, 'Edited by', 'Edited by' );

		$output .= $this->format_people( $translators_collection, false, 'Translated by', 'Translated by' );

		$output .= $page_range. $place_of_publication . $publisher . $url;

		return $output;
	}

	private function preface_or_foreword_to_an_ebook () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$book_authors = $entry_meta['book_author'];
		$editors = $entry_meta['editor'];
		$translators = $entry_meta['translator'];
		$year_of_publication = $entry_meta['year_of_publication'][0] . '. ';
		$essay_type = $entry_meta['essay_type'][0] . ' ';
		$book_title = '<i>' . $entry_meta['book_title'][0] . '. </i>';
		$place_of_publication = $entry_meta['place_of_publication'][0] . ': ';
		$publisher = $entry_meta['publisher'][0] . '. ';
		$page_range = $entry_meta['page_range'][0] . '. ';
		$url = $entry_meta['url'][0] . '.';

		$output = '';

		$output .= $this->format_people( $authors, true );

		$output .= $year_of_publication . $essay_title . $book_title;

		$output .= $this->format_people( $book_authors, false, 'by', 'by' );
		$output .= $this->format_people( $editors, false, 'Edited by', 'Edited by' );
		$output .= $this->format_people( $translators, false, 'Translated by', 'Translated by' );


		$output .= $place_of_publication . $publisher . $page_range . $url;


		return $output;
	}

	private function article_in_a_print_journal () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$translators = $entry_meta['translator'];
		$year = $entry_meta['year'][0] . '. ';
		$article_title = '"' . $entry_meta['article_title'][0] . '." ';
		$journal_title = '<i>' . $entry_meta['journal_title'][0] . ' </i>';
		$volume = $entry_meta['volume'][0] . '.';
		$issue = "no. " . $entry_meta['issue'][0] . ': ';
		$page_range = $entry_meta['page_range'][0] . '.';


		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $year . $article_title;

		$output .= $this->format_people( $translators, false, 'Translated by', 'Translated by' );


		$output .= $article_title . $journal_title . $volume . $issue . $page_range;

		return $output;
	}

	private function article_in_a_print_journal_accessed_online () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$translators = $entry_meta['translator'];
		$year = $entry_meta['year'][0] . '. ';
		$article_title = '"' . $entry_meta['article_title'][0] . '." ';
		$journal_title = '<i>' . $entry_meta['journal_title'][0] . ' </i>';
		$volume = $entry_meta['volume'][0] . '.';
		$issue = "no. " . $entry_meta['issue'][0] . ': ';
		$page_range = $entry_meta['page_range'][0] . '. ';
		$database = $entry_meta['database'][0] . '. ';
		$accession_number = $entry_meta['accession_number'][0] . '.';


		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $year . $article_title;

		$output .= $this->format_people( $translators, false, 'Translated by', 'Translated by' );

		$output .= $article_title . $journal_title . $volume . $issue . $page_range . $database . $accession_number;

		return $output;
	}

	private function article_in_a_online_journal () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$translators = $entry_meta['translator'];
		$year = $entry_meta['year'][0] . '. ';
		$article_title = '"' . $entry_meta['article_title'][0] . '." ';
		$journal_title = '<i>' . $entry_meta['journal_title'][0] . ' </i>';
		$volume = $entry_meta['volume'][0] . ':';
		$issue = "no. " . $entry_meta['issue'][0] . '. ';
		$date_accessed = $entry_meta['date_accessed'][0];


		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $year;

		$output .= $this->format_people( $translators, false, 'Translated by', 'Translated by' );

		$output .= $article_title . $journal_title . $volume . $issue . $date_accessed;

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

		if ( empty( $authors ) )
			$output .= $article_title . $year . $periodical_title . $date;
		else
			$output .= $year . $article_title . $periodical_title . $date;

		return $output;
	}

	private function article_in_a_newspaper_or_magazine_accessed_online () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$year = $entry_meta['year'][0] . '. ';
		$article_title = '"' . $entry_meta['article_title'][0] . '." ';
		$periodical_title = '<i>' . $entry_meta['periodical_title'][0] . ', </i>';
		$date = date( 'F j', $entry_meta['date'][0] ) . '. ';
		$url = $entry_meta['url'][0] . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		if ( empty( $authors ) )
			$output .= $article_title . $year . $periodical_title . $date . $url;
		else
			$output .= $year . $article_title . $periodical_title . $date . $url;

		return $output;
	}

	private function review_in_a_newspaper_or_magazine () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$source_authors = $entry_meta['source_author'];
		$year = $entry_meta['year'][0] . '. ';
		$review_title = '"' . $entry_meta['review_title'][0] . '." ';
		$source_title = 'Review of <i>' . $entry_meta['source_title'][0] . ', </i>';
		$periodical_title = '<i>' . $entry_meta['periodical_title'][0] . '. </i>';
		$date = date( 'F j', $entry_meta['date'][0] ) . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		if ( empty( $authors ) )
			$output .= $review_title . $year . $source_title;
		else
			$output .= $year . $review_title . $source_title;

		$output .= $this->format_people( $source_authors, false, 'by', 'by' );

		$output .= $periodical_title . $date;

		return $output;
	}

	private function review_in_a_newspaper_or_magazine_accessed_online () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$source_authors = $entry_meta['source_author'];
		$year = $entry_meta['year'][0] . '. ';
		$review_title = '"' . $entry_meta['review_title'][0] . '." ';
		$source_title = 'Review of <i>' . $entry_meta['source_title'][0] . ', </i>';
		$periodical_title = '<i>' . $entry_meta['periodical_title'][0] . '. </i>';
		$date = date( 'F j', $entry_meta['date'][0] ) . '. ';
		$url = $entry_meta['url'][0] . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		if ( empty( $authors ) )
			$output .= $review_title . $year;
		else
			$output .= $year . $review_title . $source_title;

		$output .= $this->format_people( $source_authors, false, 'by', 'by' );

		$output .= $periodical_title . $date . $url;

		return $output;
	}

	private function website () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$year = $entry_meta['year'][0] . '. ';
		$website_title = '<i>' . $entry_meta['website_title'][0] . '. </i>';
		$date = 'Last modified ' . date( 'F j', $entry_meta['date'][0] ) . '. ';
		$date_accessed = 'Accessed ' . date( 'F j, Y', $entry_meta['date_accessed'][0] ) . '. ';
		$url = $entry_meta['url'][0] . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		if ( empty( $authors ) )
			$output .= $website_title . $year . $date . $date_accessed . $url;
		else
			$output .= $year . $website_title . $date . $date_accessed . $url;

		return $output;
	}


	private function film_or_recorded_performance () {
		$entry_meta = $this->entry_meta;

		$directors = $entry_meta['director'];
		$film_title = '<i>' . $entry_meta['film_title'][0] . '. </i>';
		$year = $entry_meta['year'][0] . '. ';
		$film_studio = $entry_meta['film_studio'][0] . '.';

		$output = "";

		$output .= $film_title . $year;

		$output .= $this->format_people( $directors, false, 'Directed by', 'Directed by' );

		$output .= $film_studio;

		return $output;
	}

	private function film_or_recorded_performance_on_a_medium () {
		$entry_meta = $this->entry_meta;

		$directors = $entry_meta['director'];
		$film_title = '<i>' . $entry_meta['film_title'][0] . '. </i>';
		$year = $entry_meta['year'][0] . '. ';
		$distributor = $entry_meta['distributor'][0] . ', ';
		$medium = $entry_meta['medium'][0] . '.';

		$output = "";

		$output .= $film_title . $year;

		$output .= $this->format_people( $directors, false, 'Directed by', 'Directed by' );

		$output .= $distributor . $medium;

		return $output;
	}

	private function television_or_radio_program () {
		$entry_meta = $this->entry_meta;

		$directors = $entry_meta['director'];
		$episode_title = '"' . $entry_meta['episode_title'][0] . '." ';
		$year = $entry_meta['year'][0] . '. ';
		$series_title = '<i>' . $entry_meta['series_title'][0] . '. </i>';
		$network_name = $entry_meta['network_name'][0] . ', ';
		$call_letters = $entry_meta['call_letters'][0] . ', ';
		$location = $entry_meta['location'][0] . ', ';
		$date = date( 'F j', $entry_meta['date'][0] ) . '.';

		$output = "";

		$output .= $episode_title . $year;

		$output .= $this->format_people( $directors, false, 'Directed by', 'Directed by' );

		$output .= $series_title . $network_name . $call_letters . $location . $date;

		return $output;
	}

	private function television_episode_on_dvd () {
		$entry_meta = $this->entry_meta;

		$directors = $entry_meta['director'];
		$episode_title = '"' . $entry_meta['episode_title'][0] . '." ';
		$year = $entry_meta['year'][0] . '. ';
		$series_title = '<i>' . $entry_meta['series_title'][0] . '. </i>';
		$medium_title = '<i>' . $entry_meta['medium_title'][0] . '. </i>';
		$distributor = $entry_meta['distributor'][0] . ', ';
		$publication_medium = $entry_meta['publication_medium'][0] . '.';

		$output = "";

		$output .= $episode_title . $year;

		$output .= $this->format_people( $directors, false, 'Directed by', 'Directed by' );

		$output .= $series_title . $medium_title . $distributor . $publication_medium;

		return $output;
	}

	private function cd_or_album () {
		$entry_meta = $this->entry_meta;

		$artist = $entry_meta['artist'];
		$year = $entry_meta['year'][0] . '. ';
		$cd_album_title = '<i>' . $entry_meta['cd_album_title'][0] . '. </i>';
		$manufacturer = $entry_meta['manufacturer'][0] . ', ';
		$publication_medium = $entry_meta['publication_medium'][0] . '.';

		$output = "";

		$output .= $this->format_people( $directors, false );

		$output .= $year . $cd_album_title . $manufacturer . $publication_medium;

		return $output;
	}

	private function song_or_individual_audio_recording () {
		$entry_meta = $this->entry_meta;

		$artist = $entry_meta['artist'];
		$year = $entry_meta['year'][0] . '. ';
		$song_recording_title = '"' . $entry_meta['song_recording_title'][0] . '." ';
		$cd_album_title = '<i>' . $entry_meta['cd_album_title'][0] . '. </i>';
		$manufacturer = $entry_meta['manufacturer'][0] . ', ';
		$publication_medium = $entry_meta['publication_medium'][0] . '.';

		$output = "";

		$output .= $this->format_people( $directors, false );

		$output .= $year . $song_recording_title . $cd_album_title . $manufacturer . $publication_medium;

		return $output;
	}

	private function performance () {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$directors = $entry_meta['director'];
		$performance_title = '<i>' . $entry_meta['performance_title'][0] . '. </i>';
		$year = $entry_meta['year'][0] . '. ';
		$location = $entry_meta['location'][0] . ', ';
		$place_of_performance = $entry_meta['place_of_performance'][0] . ', ';
		$date = date( 'F j', $entry_meta['date'][0] ) . '.';

		$output = "";

		$output .= $performance_title . $year;

		$output .= $this->format_people( $authors, false, 'By', 'By' );
		$output .= $this->format_people( $directors, false, 'Directed by', 'Directed by' );

		$output .= $location . $place_of_performance . $date;

		return $output;
	}

	private function art_object_physical_object () {
		$entry_meta = $this->entry_meta;

		$artists = $entry_meta['artist'];
		$date = $entry_meta['date'][0] . '. ';
		$object_title = '<i>' . $entry_meta['object_title'][0] . '. </i>';
		$medium = $entry_meta['medium'][0] . '. ';
		$location = $entry_meta['location'][0] . ', ';
		$collection_museum = $entry_meta['collection_museum'][0] . '.';

		$output = "";

		$output .= $this->format_people( $artists, true );

		if ( empty( $artists ) )
			$output .= $object_title . $date . $medium . $location . $collection_museum;
		else
			$output .= $date . $object_title . $medium . $location . $collection_museum;


		return $output;

	}

	private function art_object_viewed_online () {
		$entry_meta = $this->entry_meta;

		$artists = $entry_meta['artist'];
		$date = $entry_meta['date'][0] . '. ';
		$object_title = '<i>' . $entry_meta['object_title'][0] . '. </i>';
		$medium = $entry_meta['medium'][0] . '. ';
		$location = $entry_meta['location'][0] . ', ';
		$collection_museum = $entry_meta['collection_museum'][0] . '. ';
		$url = $entry_meta['url'][0] . '.';

		$output = "";

		$output .= $this->format_people( $artists, true );

		if ( empty( $artists ) )
			$output .= $object_title . $date . $medium . $location . $collection_museum . $url;
		else
			$output .= $date . $object_title . $medium . $location . $collection_museum . $url;


		return $output;

	}

	private function personal_interview () {
		$entry_meta = $this->entry_meta;

		$interviewees = $entry_meta['interviewee'];
		$year = $entry_meta['year'][0] . '. ';
		$date = $entry_meta['date'][0] . '.';

		$output = "";

		$output .= $this->format_people( $interviewees, true );

		$output .= $year . 'Personal interview. ' . $date;


		return $output;
	}

	private function lecture_speech () {
		$entry_meta = $this->entry_meta;

		$presenters = $entry_meta['presenter'];
		$year = $entry_meta['year'][0] . '. ';
		$piece_title = '"' . $entry_meta['piece_title'][0] . '." ';
		$presentation_type = $entry_meta['presentation_type'][0] . ' ';
		$meeting_conference = $entry_meta['meeting_conference'][0] . '. ';
		$place_of_presentation = $entry_meta['place_of_presentation'][0] . '. ';
		$date = date( 'F j', $entry_meta['date'][0] ) . '.';

		$output = "";

		$output .= $this->format_people( $presenters, true );

		$output .= $year . $piece_title . $presentation_type . $meeting_conference . $place_of_presentation . $date;

		return $output;
	}



}
	