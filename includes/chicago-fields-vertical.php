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
				'type' => 'number',
				'name' => 'year_of_publication',
				'label' => 'Year of Publication',
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
				'type' => 'number',
				'name' => 'year_of_publication',
				'label' => 'Year of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
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
				'name' => 'page_range',
				'label' => 'Page Range',
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
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'essay_title',
				'validation' => array()
			),
		)
	),
	$submit_button
),
'chapter_of_an_edited_volume_originally_published_elsewhere' => array(
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
				'name' => 'primary_source_title',
				'label' => 'Primary source title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'edited_volume_title',
				'label' => 'Edited volume title',
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
				'type' => 'text',
				'name' => 'publisher',
				'label' => 'Publisher',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'place_of_publication',
				'label' => 'Place Of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'number',
				'name' => 'year_of_publication',
				'label' => 'Year Of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'textarea',
				'name' => 'originally_published_in',
				'label' => 'Originally Published In',
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
'preface_foreword_introduction_or_similar_part_of_a_book' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author of section' ),
			get_repeater_field( 'book_author', 'Book Author' ),
			get_repeater_field( 'editor', 'Book Editor' ),
			get_repeater_field( 'translator', 'Book Translator' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
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
				'name' => 'section_type',
				'label' => 'Section Type',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'section_title',
				'label' => 'Section Title',
				'validation' => array()
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
				'value' => 'book_title',
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
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
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
				'type' => 'text',
				'name' => 'date_accessed',
				'label' => 'Date Accessed',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'url',
				'label' => 'URL',
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
'chapter_or_part_of_an_ebook' => array(
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
				'type' => 'number',
				'name' => 'year_of_publication',
				'label' => 'Year of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
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
				'name' => 'page_range',
				'label' => 'Page Range',
				'validation' => array(
					'required' => 'required'
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
				'type' => 'text',
				'name' => 'date_accessed',
				'label' => 'Date Accessed',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'url',
				'label' => 'URL',
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
'preface_or_foreword_to_an_ebook' => array(
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
				'type' => 'number',
				'name' => 'year_of_publication',
				'label' => 'Year of Publication',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'essay_type',
				'label' => 'Essay Type',
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
				'type' => 'text',
				'name' => 'page_range',
				'label' => 'Page Range',
				'validation' => array()
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
				'value' => 'essay_title',
				'validation' => array()
			),
		)
	),
	$submit_button
),
'article_in_a_print_journal' => array(
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
				'name' => 'year',
				'label' => 'Year',
				'validation' => array()
			),
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
				'type' => 'number',
				'name' => 'volume',
				'label' => 'Volume',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'number',
				'name' => 'issue',
				'label' => 'Issue',
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
				'name' => 'year',
				'label' => 'Year',
				'validation' => array()
			),
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
				'type' => 'number',
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
                'name' => 'accession_number',
                'label' => 'Accession number',
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
				'name' => 'year',
				'label' => 'Year',
				'validation' => array()
			),
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
				'type' => 'number',
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
                'type' => 'text',
                'name' => 'date_accessed',
                'label' => 'Date accessed',
                'validation' => array(
                    'required' => 'required',
                )
            ),
            array(
                'type' => 'selectbox',
                'name' => 'online_reference_type',
                'class' => 'dynamic-field-select',
                'options' => array(
                	'url' => 'url',
                	'doi' => 'doi',
                ),
                'validation' => array(
                    'required' => 'required',
                ),
            ),
            array(
                'type' => 'text',
                'name' => 'url',
                'label' => 'url',
                'class' => 'dynamic-field',
                'hidden' => 'hidden',
                'validation' => array(
                	'required' => 'required'
                )
            ),
            array(
                'type' => 'text',
                'name' => 'doi',
                'label' => 'doi',
                'class' => 'dynamic-field',
                'hidden' => 'hidden',
                'validation' => array(
                	'required' => 'required'
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
'article_in_a_print_newspaper_or_magazine' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'author', 'Author' ),
		),
	),
	// TODO: missing fields go through it again with Grace
	array(
		'title' => 'General information',
		'fields' => array(
            array(
                'type' => 'text',
                'name' => 'year',
                'label' => 'Year',
                'validation' => array(
                    'required' => 'required',
                )
            ),
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
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'year',
				'label' => 'Year',
				'validation' => array(
					'required' => 'required',
				)
			),

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
                'name' => 'date',
                'label' => 'Date Accessed',
                'validation' => array(
                    'required' => 'required',
                )
            ),
            array(
                'type' => 'text',
                'name' => 'url',
                'label' => 'URL',
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
'review_in_a_newspaper_or_magazine' => array(
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
				'name' => 'year',
				'label' => 'Year',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'review_title',
				'label' => 'Review title',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'source_title',
				'label' => 'Source title',
				'validation' => array(
					'required' => 'required'
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
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'source_title', //TODO: Use Author + Review title if provided otherwise use Author + source reviewed
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
				'name' => 'year',
				'label' => 'Year',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'review_title',
				'label' => 'Review title',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'source_title',
				'label' => 'Source title',
				'validation' => array(
					'required' => 'required'
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
                'name' => 'source_section',
                'label' => 'Source Section',
                'validation' => array()
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
				'value' => 'review_title', //TODO: Use Author + Review title if provided otherwise use Author + source reviewed
				'validation' => array()
			),
		),
	),
	$submit_button
),
'thesis_or_disertation' => array(
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
				'name' => 'thesis_title',
				'label' => 'Thesis Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'selectbox',
				'name' => 'thesis_type',
				'label' => 'Thesis Type',
				'options' => array(
					'bad_iss' => 'BA diss',
					'ma_diss' => 'MA diss',
					'phd_diss' => 'PhD diss',
				),
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'text',
				'name' => 'university',
				'label' => 'University',
				'validation' => array(
					'required' => 'required'
				)
			),
			array(
				'type' => 'text',
				'name' => 'year',
				'label' => 'Year',
				'validation' => array(
					'required' => 'required'
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
'website' => array(
	array(),
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
				'name' => 'page_title',
				'label' => 'Page Title',
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
				'name' => 'url',
				'label' => 'URL',
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
				'name' => 'year',
				'label' => 'Year',
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
				'name' => 'year',
				'label' => 'Year',
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
				'type' => 'text',
				'name' => 'medium',
				'label' => 'Medium of publication',
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
				'name' => 'year',
				'label' => 'Year',
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
				'validation' => array(
					'required' => 'required'
				)
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
			get_repeater_field( 'director', 'Director' ),
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
				'name' => 'year',
				'label' => 'Year',
				'validation' => array(
					'required' => 'required'
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
				'label' => 'Name of DVD or recording',
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
				'type' => 'text',
				'name' => 'publication_medium',
				'label' => 'Medium of publication',
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
				'name' => 'year',
				'label' => 'Year',
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
				'name' => 'year',
				'label' => 'Year',
				'validation' => array(
					'required' => 'required',
				)
			),
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
				'name' => 'year',
				'label' => 'Year', // TODO: Ask Grace about name
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
				'name' => 'place_of_performance',
				'label' => 'Place of performance', // TODO: Ask Grace about name
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
				'name' => 'date',
				'label' => 'Date',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'object_title',
				'label' => 'Object title',
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
				'type' => 'text',
				'name' => 'location',
				'label' => 'Location',
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
				'name' => 'date',
				'label' => 'Date of composition',
				'validation' => array()
			),
			array(
				'type' => 'text',
				'name' => 'object_title',
				'label' => 'Object title',
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
				'type' => 'text',
				'name' => 'location',
				'label' => 'Location',
				'validation' => array(
					'required' => 'required'
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
				'name' => 'url',
				'label' => 'URL',
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
		),
	),
	// TODO: ask Grace how to solve problem with title for the post
	// Here the title should be repeater field
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'year',
				'label' => 'Year',
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
				'value' => 'interviewee',
				'validation' => array()
			),
		),
	),
	$submit_button
),
'paper_presented_at_a_meeting_or_conference' => array(
	array(
		'title' => 'Contributors',
		'fields' => array(
			get_repeater_field( 'presenter', 'Presenter' ),
		),
	),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'year',
				'label' => 'Year',
				'validation' => array(
					'required' => 'required',
				)
			),
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
				'name' => 'presentation_type',
				'label' => 'Presentation type',
				'validation' => array(
					'required' => 'required'
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
				'label' => 'Place/location of presentation',
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





