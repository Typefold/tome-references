<?php
/**
 * Stores biblio styles for chicago and mla.
 */
class BiblioFormData {

	// Biblio Style selectbox options
	public static $chicago_sources = array(
		array(
			'options_fields' => array(
				'' => 'type of source'
			)
		),
		array(
			'label' => 'Book',
			'options_fields' => array(
				"book"															=> "Whole book",
				"chapter_or_other_part_of_a_book"								=> "Chapter or other part of a book",
				"preface_foreword_introduction_or_similar_part_of_a_book"		=> "Preface foreword introduction or similar part of a book",
			)
		),
		array(
			'label' => 'Ebook',
			'options_fields' => array(
				"ebook"															=> "Whole book",
				"chapter_or_part_of_an_ebook"									=> "Chapter or part of an ebook",
				"preface_or_foreword_to_an_ebook"								=> "Preface or foreword to an ebook",
			)
		),
		array(
			'label' => 'Journal article',
			'options_fields' => array(
				"article_in_a_print_journal"									=> "Article in a print journal",
				"article_in_a_online_journal"									=> "Article in an online journal",
			)
		),
		array(
			'label' => 'Article in a newspaper or magazine',
			'options_fields' => array(		
				"article_in_a_print_newspaper_or_magazine"						=> "Article in a print newspaper or magazine",
				"article_in_a_newspaper_or_magazine_accessed_online"			=> "Article in a newspaper or magazine accessed online",
			)
		),
		array(
			'options_fields' => array(
				"thesis_or_disertation"											=> "Thesis Or Diseration",
				"website"														=> "Website",
				"paper_presented_at_a_meeting_or_conference"					=> "Paper presented at a meeting or conference",
				"chapter_of_an_edited_volume_originally_published_elsewhere"	=> "Chapter of an edited volume originally published elsewhere",
			)
		)
	);

	// Biblio Style selectbox options
	public static $mla_sources = array(
		array(
			'options_fields' => array(
				'' => 'type of source'
			)
		),
		array(
			'label' => 'Book',
			'options_fields' => array(
				"book"													=> "Whole Book",
				"chapter_or_other_part_of_a_book"						=> "Chapter or other part of a book",
				"chapter_or_part_of_an_ebook"							=> "Chapter or part of an ebook",

			)
		),
		array(
			'label' => 'Book',
			'options_fields' => array(
				"book"													=> "Whole Book",
				"chapter_or_other_part_of_a_book"						=> "Chapter_or_other_part_of_an ebook",
				"preface_or_foreword_to_a_book"							=> "Preface or foreword to an ebook",
			)
		),
		array(
			'label' => 'Journal article',
			'options_fields' => array(
				"article_in_a_print_journal"							=> "Article in a print journal",
				"article_in_a_online_journal"							=> "Articleinaonlinejournal",
				"article_in_a_print_journal_accessed_online"			=> "Article in a print journal accessed online",
			)
		),
		array(
			'label' => 'Article in a newspaper or magazine',
			'options_fields' => array(
				"article_in_a_print_newspaper_or_magazine"				=> "Article in a print newspaper or magazine",
				"article_in_a_newspaper_or_magazine_accessed_online"	=> "Article in a newspaper or magazine accessed online",
				"review_in_a_newspaper_or_magazine"						=> "Review in a newspaper or magazine",
				"review_in_a_newspaper_or_magazine_accessed_online"		=> "Review in a newspaper or magazine accessed online",
			)
		),
		array(
			'label' => 'Website',
			'options_fields' => array(
				"website"												=> "Website",
				"page_on_a_website"										=> "Page on a website",
			)
		),
		array(
			'label' => 'Film or recorded performance',
			'options_fields' => array(
				"film_or_recorded_performance"							=> "Film or recorded performance",
				"film_or_recorded_performance_on_a_medium"				=> "Film or recorded performance on a medium",
			)
		),
		array(
			'label' => 'Television episode',
			'options_fields' => array(
				"television_or_radio_program"							=> "Television or radio program",
				"television_episode_on_dvd"								=> "Television episode on dvd",
			)
		),
		array(
			'label' => 'CD or album',
			'options_fields' => array(
				"cd_or_album"											=> "Cd or album",
				"song_or_individual_audio_recording"					=> "Song or individual audio recording",
			)
		),
		array(
			'label' => 'Art object',
			'options_fields' => array(
				"art_object_physical_object"							=> "Art object physical object",
				"art_object_viewed_online"								=> "Art object viewed online",
			)
		),
		array(
			'options_fields' => array(
				"performance"											=> "Performance",
				"personal_interview"									=> "Personal interview",
				"lecture_speech"										=> "Lecture speech",
			)
		)
	);

	// Biblio Style selectbox options
	public static $custom_sources = array(
		array(
			'options_fields' => array(
				"custom" => "Custom",
			)
		)
	);


	/**
	 * @param $values (array) = associative array of option values and labels eg. 'my_option_val' => 'My Option Val',
	 * @return string
	 */
	public static function print_option_tags( $selectbox_options ) {

		$output = "";

		foreach ( $selectbox_options as $options_section => $section ) {


			$section_label = ( isset( $section['label'] ) ) ? $section['label'] : false;
			// is group of options
			$output .= ( $section_label ) ? "<optgroup label='$section_label'>" : "";



			foreach ( $section['options_fields'] as $option_value => $option_label ) {

				$output .= "<option value='$option_value'>$option_label</option>";

			}


			$output .= ( $section_label ) ? "</optgroup>" : "";
		}


		return $output;

	}




}







