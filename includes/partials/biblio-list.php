<div class="biblio-list animated modal-section<?php echo $active_section; ?>">

	<div id="biblio-entries">

		<div class="modal-header">					
			<h3>Select Bibliographic Entry</h3>
		</div>

		<input type="text" class="search" placeholder="Search" />
		
		<ul class="list">
			
			<?php foreach ($biblio as $biblio_entry): ?>

				<li class="biblio-entry">

					<?php
						$custom = get_post_custom( $biblio_entry->ID );
						$biblio_style = get_post_meta( $biblio_entry->ID, 'biblio-style', true );
						$biblio_source = get_post_meta( $biblio_entry->ID, 'type-of-source', true );
						$full_name = "";
					?>

					<h2 class="entry-title nav-button" data-target="reference-form"><?php echo substr($biblio_entry->post_title, 0, 100); ?></h2>

					<span class="entry-id" data-entry="<?php echo $biblio_entry->ID; ?>"></span>

					<span class="delete-entry">Delete</span>

					<span class="edit-link nav-button" data-target="create-biblio" data-style="<?php echo $biblio_style; ?>" data-source="<?php echo $biblio_source; ?>">edit</span>

					<span class='author-name'><span>by:</span><?php echo Biblio_Entry_Printer::get_author_name( $custom ); ?></span>

				</li>

			<?php endforeach ?>


		</ul>

		<ul class="pagination"></ul>

	</div>

	<div style="display:none;">
		<!-- A template element is needed when list is empty, TODO: needs a better solution -->
		<li class="biblio-entry" id="biblio-entry-template">

			<h2 class="entry-title nav-button" data-target="reference-form"></h2>

			<span class="entry-id" data-entry=""></span>

			<span class="delete-entry">Delete</span>

			<span class="edit-link nav-button" data-target="create-biblio" data-style="" data-source="">edit</span>

			<span class='author-name'><span>by:</span></span>

		</li>
	</div>

	<!-- Template for an biblio entry item -->
	<a href="javascript:;" class="button button-primary nav-button add-biblio" data-target="create-biblio">Add new</a>

</div>