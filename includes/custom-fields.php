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

return array(
'custom' => array(
	array(),
	array(
		'title' => 'General information',
		'fields' => array(
			array(
				'type' => 'text',
				'name' => 'biblio_title_text',
				'label' => 'Bibliography Title',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'textarea',
				'name' => 'biblio_text',
				'label' => 'Bibliography Text',
				'class' => 'tinymce-wrapper',
				'validation' => array(
					'required' => 'required',
				)
			),
			array(
				'type' => 'hidden',
				'name' => 'biblio_title',
				'value' => 'biblio_title_text',
				'validation' => array()
			),
		)
	),
	$submit_button
),
);





