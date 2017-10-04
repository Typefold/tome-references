<?php global $post; ?>

<div class="reference-form modal-section animated hidden">

	<div class="modal-header">					
		<!-- <p>To create reference you must have created atleast one bibliographyc entry, but we weren't able to find any.</p> -->
		<h3>Reference Text</h3>
		<hr>
	</div>

	<input type="hidden" class="selected-biblio-id">
	<input type="hidden" class="current-post" value="<?php echo $post->ID; ?>">

	<?php

	$settings = array(
		'textarea_name' => 'reference_text',
		'media_buttons' => false,
		'editor_height' => '100%',
	);
	wp_editor( '', 'reference_text', $settings);

	?>
	
	<a href="javascript:;" class="button button-primary add-reference" data-method="create">Use reference</a>

	<a href="javascript:;" class="back-button" data-target="biblio-list"></a>

</div>