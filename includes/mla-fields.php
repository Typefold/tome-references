<?php
return array(
'book' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
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
				'type' => 'hidden',
				'name' => 'title',
				'value' => 'book_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Editor',
		'fields' => array(
			array(
				'repeater' => 'editor',
				'title' => 'Editor',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
				),
			),
		),
	),
	array(
		'title' => 'Translator',
		'fields' => array(
			array(
				'repeater' => 'translator',
				'title' => 'Translator',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
				),
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'chapter_or_other_part_of_a_book' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
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
				'name' => 'title',
				'value' => 'essay_title',
				'validation' => array()
			),
		)
	),
	array(
		'title' => 'Essay Translator',
		'fields' => array(
			array(
				'repeater' => 'translator_essay',
				'title' => 'Essay translator',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'translator_essay'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'translator_essay'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'translator_essay'
					),
				),
			),
		),
	),
	array(
		'title' => 'Editor',
		'fields' => array(
			array(
				'repeater' => 'editor',
				'title' => 'Editor',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
				),
			),
		),
	),
	array(
		'title' => 'Collection Translator',
		'fields' => array(
			array(
				'repeater' => 'translator_collection',
				'title' => 'Collection translator',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'translator_collection'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'translator_collection'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'translator_collection'
					),
				),
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'preface_or_foreword_to_a_book' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Essay author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
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
				'name' => 'title',
				'value' => 'essay_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Book\'s Author',
		'fields' => array(
			array(
				'repeater' => 'book_author',
				'title' => 'Book author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'book_author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'book_author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'book_author'
					),
				),
			),
			array(
				'repeater' => 'editor',
				'title' => 'Editor',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
				),
			),
			array(
				'repeater' => 'translator',
				'title' => 'Translator',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
				),
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'ebook' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
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
				'type' => 'hidden',
				'name' => 'title',
				'value' => 'book_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Editor',
		'fields' => array(
			array(
				'repeater' => 'editor',
				'title' => 'Editor',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
				),
			),
		),
	),
	array(
		'title' => 'Translator',
		'fields' => array(
			array(
				'repeater' => 'translator',
				'title' => 'Translator',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
				),
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'chapter_or_part_of_an_ebook' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
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
				'validation' => array()
			),
			array(
				'type' => 'hidden',
				'name' => 'title',
				'value' => 'book_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Editor',
		'fields' => array(
			array(
				'repeater' => 'editor',
				'title' => 'Editor',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'editor'
					),
				),
			),
		),
	),
	array(
		'title' => 'Essay translator',
		'fields' => array(
			array(
				'repeater' => 'essay_translator',
				'title' => 'Essay translator',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'essay_translator'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'essay_translator'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'essay_translator'
					),
				),
			),
		),
	),
	array(
		'title' => 'Collection translator',
		'fields' => array(
			array(
				'repeater' => 'collection_translator',
				'title' => 'Collection translator',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'collection_translator'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'collection_translator'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'collection_translator'
					),
				),
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'article_in_a_print_journal' => array(
	// TODO: Is Volume optional
	// is the fromat Volume.issue
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
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
				'name' => 'title',
				'value' => 'article_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Translator',
		'fields' => array(
			array(
				'repeater' => 'translator',
				'title' => 'Translator',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
				),
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'article_in_a_print_journal_accessed_online' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
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
				'name' => 'title',
				'value' => 'article_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Translator',
		'fields' => array(
			array(
				'repeater' => 'translator',
				'title' => 'Translator',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
				),
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'article_in_a_online_journal' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
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
				'type' => 'hidden',
				'name' => 'title',
				'value' => 'article_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Translator',
		'fields' => array(
			array(
				'repeater' => 'translator',
				'title' => 'Translator',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
				),
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'article_in_a_print_newspaper_or_magazine' => array(
	// TODO: missing fields go through it again with Grace
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
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
                'name' => 'page_range',
                'label' => 'Page range',
                'validation' => array(
                    'required' => 'required',
                )
            ),
			array(
				'type' => 'hidden',
				'name' => 'title',
				'value' => 'article_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Translator',
		'fields' => array(
			array(
				'repeater' => 'translator',
				'title' => 'Translator',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
				),
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'article_in_a_newspaper_or_magazine_accessed_online' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
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
				'name' => 'title',
				'value' => 'article_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Translator',
		'fields' => array(
			array(
				'repeater' => 'translator',
				'title' => 'Translator',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
				),
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'website' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
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
				'name' => 'title',
				'value' => 'website_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'page_on_a_website' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
			),
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
				'name' => 'title',
				'value' => 'page_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'film_or_recorded_performance' => array(
	array(
		'title' => 'Basic Info',
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
				'repeater' => 'director',
				'title' => 'Director',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'director'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'director'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'director'
					),
				),
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
				'name' => 'title',
				'value' => 'film_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'film_or_recorded_performance_on_a_medium' => array(
	array(
		'title' => 'Basic Info',
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
				'repeater' => 'director',
				'title' => 'Director',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'director'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'director'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'director'
					),
				),
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
				'name' => 'title',
				'value' => 'film_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'review_in_a_newspaper_or_magazine' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
			),
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
				'name' => 'title',
				'value' => 'source_reviewed', //TODO: Use Author + Review title if provided otherwise use Author + source reviewed
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Source Author',
		'fields' => array(
			array(
				'repeater' => 'source_author',
				'title' => 'Source author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'source_author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'source_author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'source_author'
					),
				),
			),
		),
	),
	array(
		'title' => 'Translator',
		'fields' => array(
			array(
				'repeater' => 'translator',
				'title' => 'Translator',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'translator'
					),
				),
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'review_in_a_newspaper_or_magazine_accessed_online' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
				),
			),
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
				'name' => 'title',
				'value' => 'source_reviewed', //TODO: Use Author + Review title if provided otherwise use Author + source reviewed
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Source Author',
		'fields' => array(
			array(
				'repeater' => 'source_author',
				'title' => 'Source author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'source_author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'source_author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'source_author'
					),
				),
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'television_or_radio_program' => array(
	array(
		'title' => 'Basic Info',
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
				'repeater' => 'director',
				'title' => 'Director',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'director'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'director'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'director'
					),
				),
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
				'name' => 'title',
				'value' => 'episode_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'television_episode_on_dvd' => array(
	array(
		'title' => 'Basic Info',
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
				'repeater' => 'director',
				'title' => 'Director',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'director'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'director'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'director'
					),
				),
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
				'name' => 'title',
				'value' => 'episode_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'cd_or_album' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'artist',
				'title' => 'Artist',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'artist'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'artist'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'artist'
					),
				),
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
				'name' => 'title',
				'value' => 'cd_album_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'song_or_individual_audio_recording' => array(
	// TODO: figure out the "artist" field
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'artist',
				'title' => 'Artist',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'artist'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'artist'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'artist'

					),
				),
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
				'name' => 'title',
				'value' => 'song_recording_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'performance' => array(
	// TODO: By: in a listing should be director
	// TODO: figure out "artist" field
	array(
		'title' => 'Basic Info',
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
				'repeater' => 'author',
				'title' => 'Author',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'author'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'author'

					),
				),
			),
			array(
				'repeater' => 'director',
				'title' => 'Director',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'director'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'director'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(
							'required' => 'required'
						),
						'repeater_children' => 'director'
					),
				),
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
				'name' => 'title',
				'value' => 'performance_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'art_object_physical_object' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'artist',
				'title' => 'Artist',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'artist'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'artist'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'artist'
					),
				),
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
				'name' => 'title',
				'value' => 'object_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'art_object_viewed_online' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'artist',
				'title' => 'Artist',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'artist'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'artist'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'artist'
					),
				),
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
				'name' => 'title',
				'value' => 'object_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'personal_interview' => array(
	// TODO: ask Grace how to solve problem with title for the post
	// Here the title should be repeater field
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'interviewee',
				'title' => 'Interviewee',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'interviewee'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'interviewee'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'interviewee'
					),
				),
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
				'name' => 'title',
				'value' => 'interviewee',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),
'lecture_speech' => array(
	array(
		'title' => 'Basic Info',
		'fields' => array(
			array(
				'repeater' => 'presenter',
				'title' => 'Presenter',
				'fields' => array(
					array(
						'type' => 'text',
						'label' => 'First',
						'name' => 'first_name',
						'validation' => array(),
						'repeater_children' => 'presenter'
					),
					array(
						'type' => 'text',
						'label' => 'Middle',
						'name' => 'middle_name',
						'validation' => array(),
						'repeater_children' => 'presenter'
					),
					array(
						'type' => 'text',
						'label' => 'Last',
						'name' => 'last_name',
						'validation' => array(),
						'repeater_children' => 'presenter'
					),
				),
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
				'name' => 'title',
				'value' => 'piece_title',
				'validation' => array()
			),
		),
	),
	array(
		'title' => 'Complete',
		'fields' => array(
			array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'button button-primary save-bibliography',
				'validation' => array()
			),
		),
	),
),


);