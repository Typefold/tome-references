<?php

$submit_button = array(
	'title' => '',
	'fields' => array(
		array(
			'type' => 'submit',
			'value' => 'Create Bibliographic entry',
			'class' => 'button button-primary save-bibliography',
			'validation' => array()
			),
		),
	);

if ( ! function_exists('get_repeater_field') ) {
	function get_repeater_field( $repeater_name, $repeater_title, $first_name_validation = array(), $last_name_validation = array() ) {

		return array(
			'repeater' => $repeater_name,
			'title' => $repeater_title,
			'fields' => array(
				array(
					'type' => 'text',
					'label' => 'First',
					'name' => 'first_name',
					'validation' => $first_name_validation,
					'repeater_children' => $repeater_name
					),
				array(
					'type' => 'text',
					'label' => 'Middle',
					'name' => 'middle_name',
					'validation' => array(),
					'repeater_children' => $repeater_name
					),
				array(
					'type' => 'text',
					'label' => 'Last',
					'name' => 'last_name',
					'validation' => $last_name_validation,
					'repeater_children' => $repeater_name
					),
				),
			);
	}
}

return array(
'book' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author' ),
			get_repeater_field( 'editor', 'Editor' ),
			get_repeater_field( 'translator', 'Translator' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'book_title',
				'label' => 'Book Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'place_of_publication',
				'label' => 'Place of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'publisher',
				'label' => 'Publisher',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'year_of_publication',
				'label' => 'Year of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'book_title',
				'validation' => array()
			),
		)
	),
	$submit_button
),
'chapter_or_other_part_of_a_book' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author' ),
			get_repeater_field( 'editor', 'Editor' ),
			get_repeater_field( 'translator_essay', 'Essay translator' ),
			get_repeater_field( 'translator_collection', 'Collection translator' ),
		)
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'essay_title',
				'label' => 'Essay Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'book_title',
				'label' => 'Book Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'place_of_publication',
				'label' => 'Place of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'publisher',
				'label' => 'Publisher',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'year_of_publication',
				'label' => 'Year of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'page_range',
				'label' => 'Page Range',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'essay_title',
				'validation' => array()
			),
		)
	),
	$submit_button
),
'preface_or_foreword_to_a_book' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Essay Author' ),
			get_repeater_field( 'book_author', 'Book Author' ),
			get_repeater_field( 'editor', 'Editor' ),
			get_repeater_field( 'translator', 'Translator' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'essay_title',
				'label' => 'Essay Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'book_title',
				'label' => 'Book Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'place_of_publication',
				'label' => 'Place of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'publisher',
				'label' => 'Publisher',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'year_of_publication',
				'label' => 'Year of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'page_range',
				'label' => 'Page Range',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'essay_title',
				'validation' => array()
			),
		)
	),
	$submit_button
),
'ebook' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author' ),
			get_repeater_field( 'editor', 'Editor' ),
			get_repeater_field( 'translator', 'Translator' ),
			get_repeater_field( 'book_author', 'Book Author' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'book_title',
				'label' => 'Book Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'place_of_publication',
				'label' => 'Place of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'publisher',
				'label' => 'Publisher',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'year_of_publication',
				'label' => 'Year of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'book_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'chapter_or_part_of_an_ebook' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author' ),
			get_repeater_field( 'editor', 'Editor' ),
			get_repeater_field( 'essay_translator', 'Essay translator' ),
			get_repeater_field( 'collection_translator', 'Collection translator' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'book_title',
				'label' => 'Book Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'place_of_publication',
				'label' => 'Place of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'publisher',
				'label' => 'Publisher',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'year_of_publication',
				'label' => 'Year of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'page_range',
				'label' => 'Page Range',
				'validation' => array()
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'book_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'article_in_a_print_journal' => array(
	// TODO: Is Volume optional
	// is the fromat Volume.issue
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author' ),
			get_repeater_field( 'translator', 'Translator' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'article_title',
				'label' => 'Article Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'journal_title',
				'label' => 'Journal Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'volume',
				'label' => 'Volume',
				'validation' => array()
			),
			array(
				'type' => 'number',
				'name' => 'issue',
				'label' => 'Issue',
				'validation' => array()
			),
			array(
				'type' => 'number',
				'name' => 'year',
				'label' => 'Year',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'page_range',
				'label' => 'Page range',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'article_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'article_in_a_print_journal_accessed_online' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author' ),
			get_repeater_field( 'translator', 'Translator' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'article_title',
				'label' => 'Article Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'journal_title',
				'label' => 'Journal Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'volume',
				'label' => 'Volume',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'issue',
				'label' => 'Issue',
				'validation' => array()
			),
			array(
				'type' => 'number',
				'name' => 'year',
				'label' => 'Year',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'page_range',
				'label' => 'Page range',
				'validation' => array(
					'required' => 'required',
				)
			),
            array(
                'type' => 'text',
                'name' => 'database',
                'label' => 'Database',
                'validation' => array(
                    'required' => 'required',
                )
            ),
            array(
                'type' => 'text',
                'name' => 'date_accessed',
                'label' => 'Date accessed',
                'validation' => array(
                    'required' => 'required',
                )
            ),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'article_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'article_in_a_online_journal' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author' ),
			get_repeater_field( 'translator', 'Translator' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'article_title',
				'label' => 'Article Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'journal_title',
				'label' => 'Journal Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'volume',
				'label' => 'Volume',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'issue',
				'label' => 'Issue',
				'validation' => array()
			),
			array(
				'type' => 'number',
				'name' => 'year',
				'label' => 'Year',
				'validation' => array()
			),
            array(
                'type' => 'text',
                'name' => 'date_accessed',
                'label' => 'Date accessed',
                'validation' => array(
                    'required' => 'required',
                )
            ),
            array(
                'type' => 'text',
                'name' => 'url',
                'label' => 'URL',
                'validation' => array()
            ),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'article_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'article_in_a_print_newspaper_or_magazine' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author' ),
			get_repeater_field( 'translator', 'Translator' ),
		),
	),
	// TODO: missing fields go through it again with Grace
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'article_title',
				'label' => 'Article Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'periodical_title',
				'label' => 'Periodical title',
				'validation' => array(
					'required' => 'required',
				)
			),
            array(
                'type' => 'text',
                'name' => 'date',
                'label' => 'Date',
                'validation' => array(
                    'required' => 'required',
                )
            ),
            array(
                'type' => 'text',
                'name' => 'page_range',
                'label' => 'Page range',
                'validation' => array(
                    'required' => 'required',
                )
            ),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'article_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'article_in_a_newspaper_or_magazine_accessed_online' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author' ),
			get_repeater_field( 'translator', 'Translator' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'article_title',
				'label' => 'Article Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'periodical_title',
				'label' => 'Periodical title',
				'validation' => array(
					'required' => 'required',
				)
			),
            array(
                'type' => 'text',
                'name' => 'piece_publisher',
                'label' => 'Piece publisher',
                'validation' => array(
                    'required' => 'required',
                )
            ),
            array(
                'type' => 'text',
                'name' => 'date',
                'label' => 'Date',
                'validation' => array(
                    'required' => 'required',
                )
            ),
            array(
                'type' => 'text',
                'name' => 'date_accessed',
                'label' => 'Date accessed',
                'validation' => array(
                    'required' => 'required',
                )
            ),
            array(
                'type' => 'text',
                'name' => 'page_range',
                'label' => 'Page range',
                'validation' => array(
                    'required' => 'required',
                )
            ),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'article_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'website' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'website_title',
				'label' => 'Website title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'publisher_sponsor',
				'label' => 'Publiser/Sponsor',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'date',
				'label' => 'Date',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'date_accessed',
				'label' => 'Date accessed',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'website_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'page_on_a_website' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'page_title',
				'label' => 'Page title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'website_title',
				'label' => 'Website title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'publisher_sponsor',
				'label' => 'Publiser / Sponsor',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'date',
				'label' => 'Date',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'date_accessed',
				'label' => 'Date accessed',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'page_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'film_or_recorded_performance' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'director', 'Director', array('required' => 'required'), array('required' => 'required') ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'film_title',
				'label' => 'Film title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'film_studio',
				'label' => 'Film studio',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'year',
				'label' => 'Year',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'film_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'film_or_recorded_performance_on_a_medium' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'director', 'Director', array('required' => 'required'), array('required' => 'required') ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'film_title',
				'label' => 'Film title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'distributor',
				'label' => 'Distributor',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'year',
				'label' => 'Year',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'medium',
				'label' => 'Medium',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'film_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'review_in_a_newspaper_or_magazine' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author'),
			get_repeater_field( 'translator', 'Translator'),
			get_repeater_field( 'source_author', 'Source author', array('required' => 'required'), array('required' => 'required') ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'review_title',
				'label' => 'Review title',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'source_reviewed',
				'label' => 'Source reviewed',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'periodical_title',
				'label' => 'Periodical title',
				'validation' => array(
					'required' => 'required',
				)
			),
            array(
                'type' => 'text',
                'name' => 'date',
                'label' => 'Date',
                'validation' => array(
                    'required' => 'required',
                )
            ),
            array(
                'type' => 'text',
                'name' => 'page_range',
                'label' => 'Page range',
                'validation' => array(
                    'required' => 'required',
                )
            ),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'source_reviewed', //TODO: Use Author + Review title if provided otherwise use Author + source reviewed
				'validation' => array()
			),
		),
	),
	$submit_button
),
'review_in_a_newspaper_or_magazine_accessed_online' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author'),
			get_repeater_field( 'source_author', 'Source author', array('required' => 'required'), array('required' => 'required') ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'review_title',
				'label' => 'Review title',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'source_reviewed',
				'label' => 'Source reviewed',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'periodical_title',
				'label' => 'Periodical title',
				'validation' => array(
					'required' => 'required',
				)
			),
            array(
                'type' => 'text',
                'name' => 'date',
                'label' => 'Date',
                'validation' => array(
                    'required' => 'required',
                )
            ),
            array(
                'type' => 'text',
                'name' => 'date_accessed',
                'label' => 'Date accessed',
                'validation' => array(
                    'required' => 'required',
                )
            ),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'source_reviewed', //TODO: Use Author + Review title if provided otherwise use Author + source reviewed
				'validation' => array()
			),
		),
	),
	$submit_button
),
'television_or_radio_program' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'director', 'Director'),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'episode_title',
				'label' => 'Episode title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'series_title',
				'label' => 'Series title',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'network_name',
				'label' => 'Network name',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'call_letters',
				'label' => 'Call letters',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'location',
				'label' => 'Location',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'date',
				'label' => 'date',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'text',
				'name' => 'broadcast_medium',
				'label' => 'broadcast medium',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'episode_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'television_episode_on_dvd' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'director', 'Director', array('required' => 'required'), array('required' => 'required') ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'episode_title',
				'label' => 'Episode title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'series_title',
				'label' => 'Series Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'medium_title',
				'label' => 'Medium title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'distributor',
				'label' => 'Distributor',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'number',
				'name' => 'year',
				'label' => 'Year',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'text',
				'name' => 'publication_medium',
				'label' => 'Publication medium',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'episode_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'cd_or_album' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'artist', 'Artist', array('required' => 'required'), array('required' => 'required') ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'cd_album_title',
				'label' => 'CD/Album title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'manufacturer',
				'label' => 'Manufacturer',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'year',
				'label' => 'Year',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'publication_medium',
				'label' => 'Publication medium',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'cd_album_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'song_or_individual_audio_recording' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'artist', 'Artist', array('required' => 'required'), array('required' => 'required') ),
		),
	),
	// TODO: figure out the "artist" field
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'song_recording_title',
				'label' => 'Song/Recording title', // TODO: Ask Grace about name
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'cd_album_title',
				'label' => 'CD/Album title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'manufacturer',
				'label' => 'Manufacturer',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'year',
				'label' => 'Year',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'publication_medium',
				'label' => 'Publication medium',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'song_recording_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'performance' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author' ),
			get_repeater_field( 'director', 'Director', array('required' => 'required'), array('required' => 'required') ),
		),
	),
	// TODO: By: in a listing should be director
	// TODO: figure out "artist" field
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'performance_title',
				'label' => 'Performance title', // TODO: Ask Grace about name
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'place_of_performance',
				'label' => 'Place of performance', // TODO: Ask Grace about name
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'location',
				'label' => 'Location',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'date',
				'label' => 'Date',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'performance_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'art_object_physical_object' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'artist', 'Artist' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'object_title',
				'label' => 'Object title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'year_created',
				'label' => 'Year created',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'medium',
				'label' => 'Medium',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'collection_museum',
				'label' => 'Collection/Museum',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'location',
				'label' => 'location',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'object_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'art_object_viewed_online' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'artist', 'Artist' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'object_title',
				'label' => 'Object title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'year_created',
				'label' => 'Year created',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'medium',
				'label' => 'Medium',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'collection_museum',
				'label' => 'Collection/Museum',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'location',
				'label' => 'Location',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'text',
				'name' => 'website_name',
				'label' => 'Website name',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'text',
				'name' => 'date_accessed',
				'label' => 'date_accessed',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'object_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'personal_interview' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'interviewee', 'Interviewee' ),
			get_repeater_field( 'director', 'Director', array('required' => 'required'), array('required' => 'required') ),
		),
	),
	// TODO: ask Grace how to solve problem with title for the post
	// Here the title should be repeater field
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'date',
				'label' => 'Date',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'interviewee',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'lecture_speech' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'presenter', 'Presenter' ),
			get_repeater_field( 'director', 'Director', array('required' => 'required'), array('required' => 'required') ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'piece_title',
				'label' => 'Piece title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'meeting_conference',
				'label' => 'Meeting/Conference',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'place_of_presentation',
				'label' => 'Place of presentation',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'text',
				'name' => 'location',
				'label' => 'Location',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'text',
				'name' => 'date',
				'label' => 'Date',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'text',
				'name' => 'presentation_type',
				'label' => 'Presentation type',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'piece_title',
				'validation' => array()
			),
		),
	),
	$submit_button
),


);