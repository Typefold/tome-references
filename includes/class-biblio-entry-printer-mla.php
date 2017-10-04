<?php
/**
* Is used to handle saving new Bibliographic Entry
*/
class Biblio_Entry_Printer_Mla extends Biblio_Entry_Printer
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
				$biblio_entry = $this->book( 'Web' );
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
	private function book( $ending = 'Print.' ) {

		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$editors = $entry_meta['editor'];
		$translators = $entry_meta['translator'];
		$book_title = '<i>' . $entry_meta['book_title'][0] . '. </i> ';
		$place_of_publication = $entry_meta['place_of_publication'][0] . ': ';
		$publisher = $entry_meta['publisher'][0] . ', ';
		$year_of_publication = $entry_meta['year_of_publication'][0] . '. ';


		$output = '';

		$output .= $this->format_people( $authors, true );

		$output .= $book_title;

		$output .= $this->format_people( $translators, false, 'Trans.', 'Trans.' );

		$output .= $place_of_publication . $publisher . $year_of_publication . $ending;


		return $output;
	}

	private function chapter_or_other_part_of_a_book() {

		$entry_meta = $this->entry_meta;

		$authors                = $entry_meta['author'];
		$editors                = $entry_meta['editor'];
		$translators_essay      = $entry_meta['translator_essay'];
		$translators_collection = $entry_meta['translator_collection'];
		$essay_title            = '"' . $entry_meta['essay_title'][0] . '" ';
		$book_title             = '<i>' . $entry_meta['book_title'][0] . '.</i> ';
		$place_of_publication   = $entry_meta['place_of_publication'][0] . ': ';
		$publisher              = $entry_meta['publisher'][0] . ', ';
		$year_of_publication    = $entry_meta['year_of_publication'][0] . '. ';
		$page_range             = $entry_meta['page_range'][0];

		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $essay_title . $book_title;

		$output .= $this->format_people( $editors, false, 'Ed.', 'Eds.' );

		$output .= $this->format_people( $translators_collection, false, 'Trans.', 'Trans.' );

		$output .= $place_of_publication . $publisher . $year_of_publication  . $page_range . '. Print.';

		return $output;
	}

	private function chapter_or_part_of_an_ebook() {
		$entry_meta = $this->entry_meta;

		$authors = $entry_meta['author'];
		$editors = $entry_meta['editor'];
		$translators = $entry_meta['translator'];
		$book_title = '<i>' . $entry_meta['book_title'][0] . '.</i> ';
		$place_of_publication = $entry_meta['place_of_publication'][0] . ': ';
		$publisher = $entry_meta['publisher'][0] . ', ';
		$year_of_publication = $entry_meta['year_of_publication'][0] . '. ';
		$page_range = $entry_meta['year_of_publication'][0] . '. ';


		$output = '';

		$output .= $this->format_people( $authors, true );

		$output .= $book_title;

		$output .= $this->format_people( $translators, false, 'Trans.' );

		$output .= $place_of_publication . $publisher . $year_of_publication . $page_range . 'Web.';


		return $output;
	}

	private function preface_or_foreword_to_a_book() {
		$entry_meta = $this->entry_meta;

		$authors              = $entry_meta['author'];
		$editors              = $entry_meta['editor'];
		$translators          = $entry_meta['translator'];
		$essay_title          = '"' . $entry_meta['essay_title'][0] . '." ';
		$book_title           = '<i>' . $entry_meta['book_title'][0] . '.</i> ';
		$place_of_publication = $entry_meta['place_of_publication'][0] . ': ';
		$publisher            = $entry_meta['publisher'][0] . ', ';
		$year_of_publication  = $entry_meta['year_of_publication'][0] . '. ';
		$page_range           = $entry_meta['page_range'][0] . '. ';


		$output = '';

		$output .= $this->format_people( $authors, true );

		$output .= $essay_title . $book_title;

		$output .= $this->format_people( $translators, false, 'Trans.', 'Trans.' );


		$output .= $place_of_publication . $publisher . $year_of_publication . $page_range . 'Print.';


		return $output;
	}

	private function article_in_a_print_journal() {
		$entry_meta = $this->entry_meta;

		$authors       = $entry_meta['author'];
		$translators   = $entry_meta['translator'];
		$article_title = '"' . $entry_meta['article_title'][0] .'." ';
		$journal_title = '<i>' . $entry_meta['journal_title'][0] . '.</i> ';
		$volume        = $entry_meta['volume'][0] . '.';
		$issue         = $entry_meta['issue'][0] . ' ';
		$year          = '(' . $entry_meta['year'][0] . '): ';
		$page_range    = $entry_meta['page_range'][0] . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $article_title;

		$output .= $this->format_people( $translators, false, 'Trans.', 'Trans.' );


		$output .= $journal_title . $volume . $issue . $year . $page_range . ' Print.';

		return $output;
	}

	private function article_in_a_print_journal_accessed_online() {
		$entry_meta = $this->entry_meta;

		$authors       = $entry_meta['author'];
		$translators   = $entry_meta['translator'];
		$article_title = '"' . $entry_meta['article_title'][0] .'." ';
		$journal_title = '<i>' . $entry_meta['journal_title'][0] . '.</i> ';
		$volume        = $entry_meta['volume'][0] . '.';
		$issue         = $entry_meta['issue'][0] . ' ';
		$year          = '(' . $entry_meta['year'][0] . '): ';
		$page_range    = $entry_meta['page_range'][0] . '. ';
		$database      = $entry_meta['database'][0] . '. ';
		$date_accessed = date( 'j M Y', $entry_meta['date_accessed'][0] ) . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $article_title;

		$output .= $this->format_people( $translators, false, 'Trans.' );

		$output .= $journal_title . $volume . $issue . $year . $page_range . $database . 'Web. ' . $date_accessed ;

		return $output;
	}

	private function article_in_a_online_journal() {
		$entry_meta = $this->entry_meta;

		$authors       = $entry_meta['author'];
		$translators   = $entry_meta['translator'];
		$article_title = '"' . $entry_meta['article_title'][0] .'." ';
		$journal_title = '<i>' . $entry_meta['journal_title'][0] . '.</i> ';
		$volume        = $entry_meta['volume'][0] . '.';
		$issue         = $entry_meta['issue'][0] . ' ';
		$year          = '(' . $entry_meta['year'][0] . '). ';
		$date_accessed = date( 'j M Y', $entry_meta['date_accessed'][0] ) . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $article_title;

		$output .= $this->format_people( $translators, false, 'Trans.', 'Trans.' );

		$output .= $journal_title . $volume . $issue . $year . 'Web. ' . $date_accessed;

		return $output;
	}

	private function article_in_a_print_newspaper_or_magazine() {
		$entry_meta = $this->entry_meta;

		$authors          = $entry_meta['author'];
		$article_title    = '"' . $entry_meta['article_title'][0] .'." ';
		$periodical_title = '<i>' . $entry_meta['periodical_title'][0] . '.</i> ';
		$date             = date( 'j M Y', $entry_meta['date'][0] ) . ': ';
		$page_range       = $entry_meta['page_range'][0] . '. ';

		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $article_title . $periodical_title . $date . $page_range;

		$output .= 'Print.';

		return $output;
	}

	private function article_in_a_newspaper_or_magazine_accessed_online() {
		$entry_meta = $this->entry_meta;

		$authors          = $entry_meta['author'];
		$article_title    = '"' . $entry_meta['article_title'][0] .'." ';
		$periodical_title = '<i>' . $entry_meta['periodical_title'][0] . '.</i> ';
		$piece_publisher  = $entry_meta['piece_publisher'][0] . ', ';
		$date             = date( 'j M Y', $entry_meta['date'][0] ) . '. ';
		$date_accessed    = date( 'j M Y', $entry_meta['date_accessed'][0] ) . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $article_title . $periodical_title . $piece_publisher . $date . 'Web. ' . $date_accessed;

		return $output;
	}

	private function review_in_a_newspaper_or_magazine() {
		$entry_meta = $this->entry_meta;

		$authors          = $entry_meta['author'];
		$source_authors   = $entry_meta['source_author'];
		$review_title     = $entry_meta['review_title'][0];
		$review_title     = ( !empty( $review_title ) ) ? '"' . $review_title .'." ' : "";
		$source_reviewed  = 'Rev. of <i>' . $entry_meta['source_reviewed'][0] . ', </i> ';
		$periodical_title = '<i>' . $entry_meta['periodical_title'][0] . '</i>. ';
		$date             = date( 'j M Y', $entry_meta['date'][0] ) . ': ';
		$page_range       = $entry_meta['page_range'][0] . '. ';

		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $review_title . $source_reviewed;

		$output .= $this->format_people( $source_authors, false, 'by', 'by' );

		$output .= $periodical_title . $date . $page_range . 'Print.';

		return $output;
	}

	private function review_in_a_newspaper_or_magazine_accessed_online() {
		$entry_meta = $this->entry_meta;

		$authors          = $entry_meta['author'];
		$source_authors   = $entry_meta['source_author'];
		$review_title     = $entry_meta['review_title'][0];
		$review_title     = ( !empty( $review_title ) ) ? '"' . $review_title .'." ' : "";
		$source_reviewed  = 'Rev. of <i>' . $entry_meta['source_reviewed'][0] . ', </i> ';
		$periodical_title = '<i>' . $entry_meta['periodical_title'][0] . '</i>. ';
		$date             = date( 'j M Y', $entry_meta['date'][0] ) . '. ';
		$date_accessed    = date( 'j M Y', $entry_meta['date_accessed'][0] ) . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $review_title . $source_reviewed;

		$output .= $this->format_people( $source_authors, false, 'by', 'by' );

		$output .= $periodical_title . $date . 'Web. ' . $date_accessed;

		return $output;
	}


	private function website() {
		$entry_meta = $this->entry_meta;

		$authors           = $entry_meta['author'];
		$website_title     = '<i>' . $entry_meta['website_title'][0] . '. </i> ';
		$publisher_sponsor = $entry_meta['publisher_sponsor'][0] . ', ';
		$date              = date( 'j M Y', $entry_meta['date'][0] ) . '. ';
		$date_accessed     = date( 'j M Y', $entry_meta['date_accessed'][0] ) . '.';

		$output = "";


		$output .= $this->format_people( $authors, true );

		$output .= $website_title;

		if ( !empty( $publisher_sponsor ) )
			$output .= $publisher_sponsor;

		if ( !empty( $date ) )
			$output .= $date;


		$output .= 'Web. ' . $date_accessed;

		return $output;
	}

	private function page_on_a_website() {
		$entry_meta = $this->entry_meta;

		$authors           = $entry_meta['author'];
		$page_title        = '"' . $entry_meta['page_title'][0] . '." ';
		$website_title     = '<i>' . $entry_meta['website_title'][0] . '. </i> ';
		$publisher_sponsor = $entry_meta['publisher_sponsor'][0] . ', ';
		$date              = date( 'j M Y', $entry_meta['date'][0] ) . '. ';
		$date_accessed     = date( 'j M Y', $entry_meta['date_accessed'][0] ) . '.';

		$output = "";

		$output .= $this->format_people( $authors, true );

		$output .= $page_title . $website_title;

		$output .= $this->format_people( $translators, false, 'Trans.', 'Trans.' );

		if ( !empty( $publisher_sponsor ) )
			$output .= $publisher_sponsor;

		if ( !empty( $date ) )
			$output .= $date;

		$output .= 'Web. ' . $date_accessed;


		return $output;
	}

	private function film_or_recorded_performance() {
		$entry_meta = $this->entry_meta;

		$directors    = $entry_meta['director'];
		$film_title  = '<i>' . $entry_meta['film_title'][0] . '. </i>';
		$film_studio = $entry_meta['film_studio'][0] . ', ';
		$year        = $entry_meta['year'][0] . '. ';

		$output = "";

		$output .= $film_title;

		$output .= $this->format_people( $directors, false, 'Dir.', 'Dir.' ); // TODO: Ask Grace about multiple prefix

		$output .= $film_studio . $year . 'Film.';

		return $output;
	}

	private function film_or_recorded_performance_on_a_medium() {
		$entry_meta = $this->entry_meta;

		$directors    = $entry_meta['director'];
		$film_title  = '<i>' . $entry_meta['film_title'][0] . '. </i>';
		$distributor = $entry_meta['distributor'][0] . ', ';
		$year        = $entry_meta['year'][0] . '. ';
		$medium      = $entry_meta['medium'][0] . '.';

		$output = "";

		$output .= $film_title;

		$output .= $this->format_people( $directors, false, 'Dir.', 'Dir.' );

		$output .= $distributor . $year . $medium;

		return $output;
	}

	private function television_or_radio_program() {
		$entry_meta = $this->entry_meta;

		$directors        = $entry_meta['director'];
		$episode_title    = '"' . $entry_meta['episode_title'][0] . '." ';	
		$series_title     = '<i>' . $entry_meta['series_title'][0] . '. </i>';
		$network_name     = $entry_meta['network_name'][0] . '. ';
		$call_letters     = $entry_meta['call_letters'][0] . ', ';
		$location         = $entry_meta['location'][0] . '. ';
		$date             = date( 'j M Y', $entry_meta['date'][0] ) . '. ';
		$broadcast_medium = $entry_meta['broadcast_medium'][0] . '.';

		$output = "".

		$output .= $episode_title;
		$output .= $this->format_people( $directors, false, 'Dir.', 'Dir.' );
		$output .= $series_title . $network_name;

		if ( !empty( $call_letters ) )
			$output .= $call_letters;

		if ( !empty( $location ) )
			$output .= $location;

		$output .= $date . $broadcast_medium;

		return $output;
	}

	private function television_episode_on_dvd() {
		$entry_meta = $this->entry_meta;

		$directors          = $entry_meta['director'];
		$episode_title      = '"' . $entry_meta['episode_title'][0] . '." ';	
		$series_title       = '<i>' . $entry_meta['series_title'][0] . '. </i>';
		$medium_title       = '<i>' . $entry_meta['medium_title'][0] . '. </i>';
		$distributor        = $entry_meta['distributor'][0] . ', ';
		$year               = $entry_meta['year'][0] . '. ';
		$publication_medium = $entry_meta['publication_medium'][0] . '.';

		$output = "".

		$output .= $episode_title;

		$output .= $this->format_people( $directors, false, 'Dir.', 'Dir.' );

		$output .= $series_title . $medium_title . $distributor . $year . $publication_medium;


		return $output;
	}

	private function cd_or_album() {
		$entry_meta = $this->entry_meta;

		// TODO: Here should be probably something else than "Artist: first_name & last_name" fields
		$artists            = $entry_meta['artist'];
		$cd_album_title     = '<i>' . $entry_meta['cd_album_title'][0] . '. </i>';		
		$manufacturer       = $entry_meta['manufacturer'][0] . ', ';
		$year               = $entry_meta['year'][0] . '. ';
		$publication_medium = $entry_meta['publication_medium'][0] . '. ';

		$output = "".

		$output .= $this->format_people( $artists, false );

		$output .= $cd_album_title . $manufacturer . $year . $publication_medium;

		return $output;
	}

	private function song_or_individual_audio_recording() {
		$entry_meta = $this->entry_meta;

		// TODO: Here should be probably something else than "Artist: first_name & last_name" fields
		$artists              = $entry_meta['artist'];
		$song_recording_title = '"' . $entry_meta['song_recording_title'][0] . '." ';
		$cd_album_title       = '<i>' . $entry_meta['cd_album_title'][0] . '. </i>';		
		$manufacturer         = $entry_meta['manufacturer'][0] . ', ';
		$year                 = $entry_meta['year'][0] . '. ';
		$publication_medium   = $entry_meta['publication_medium'][0] . '. ';

		$output = "".

		$output .= $this->format_people( $artists, false );
		$output .= $song_recording_title . $cd_album_title . $manufacturer . $year . $publication_medium;

		return $output;
	}

	private function performance() {
		$entry_meta = $this->entry_meta;

		$authors              = $entry_meta['author'];
		$directors            = $entry_meta['director'];
		$performance_title    = '<i>' . $entry_meta['performance_title'][0] . '. </i>';
		$place_of_performance = $entry_meta['place_of_performance'][0] . ', ';
		$location             = $entry_meta['location'][0] . '. ';
		$date                 = date( 'j M Y', $entry_meta['date'][0] ) . '. ';

		$output = "".

		$output .=  $performance_title;

		$output .= $this->format_people( $authors, true, 'By', 'By' );

		$output .= $this->format_people( $directors, false, 'Dir.', 'Dir.' );

		$output .= $place_of_performance . $location  . $date . 'Performance.';

		return $output;
	}

	private function art_object_physical_object() {
		$entry_meta = $this->entry_meta;

		$artists           = $entry_meta['artist'];
		$object_title      = '<i>' . $entry_meta['object_title'][0] . '. </i>';
		$year_created      = $entry_meta['year_created'][0] . '. ';
		$medium            = $entry_meta['medium'][0] . '. ';
		$collection_museum = $entry_meta['collection_museum'][0] . ', ';
		$location          = $entry_meta['location'][0] . '.';


		$output = "".

		$output .= $this->format_people( $artists, true );

		$output .= $object_title . $year_created . $medium . $collection_museum . $location;

		return $output;
	}

	private function art_object_viewed_online() {
		$entry_meta = $this->entry_meta;

		$artists           = $entry_meta['artist'];
		$object_title      = '<i>' . $entry_meta['object_title'][0] . '. </i>';
		$year_created      = $entry_meta['year_created'][0] . '. ';
		$medium            = $entry_meta['medium'][0] . '. ';
		$collection_museum = $entry_meta['collection_museum'][0] . ', ';
		$location          = $entry_meta['location'][0] . '. ';
		$website_name      ='<i>' . $entry_meta['website_name'][0] . '. </i>';
		$date_accessed     = date( 'j M Y', $entry_meta['date_accessed'][0] ) . '.';


		$output = "".

		$output .= $this->format_people( $artists, true );

		$output .= $object_title . $year_created . $medium . $collection_museum . $location . $website_name . 'Web. '. $date_accessed;

		return $output;
	}

	private function personal_interview() {
		$entry_meta = $this->entry_meta;

		$interviewees = $entry_meta['interviewee'];
		$date         = date( 'j M Y', $entry_meta['date'][0] ) . '.';


		$output = "".

		$output .= $this->format_people( $interviewees, true ) . 'Personal interview. ' . $date;

		return $output;
	}

	private function lecture_speech() {
		$entry_meta = $this->entry_meta;

		$presenters           = $entry_meta['presenter'];
		$piece_title = '"' . $entry_meta['piece_title'][0] . '." ';
		$meeting_conference = $entry_meta['meeting_conference'][0] . '. ';
		$place_of_presentation = $entry_meta['place_of_presentation'][0] . ', ';
		$location = $entry_meta['location'][0] . '. ';
		$date = date( 'j M Y', $entry_meta['date'][0] ) . '. ';
		$presentation_type = $entry_meta['presentation_type'][0] . '.';


		$output = "".

		$output .= $this->format_people( $presenters, true );

		$output .= $piece_title . $meeting_conference . $place_of_presentation . $location . $date . $presentation_type;

		return $output;
	}


}
	