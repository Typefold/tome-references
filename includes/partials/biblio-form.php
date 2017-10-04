<div class="create-biblio modal-section animated hidden">					
	<div class="modal-header">					
		<!-- <p>To create reference you must have created atleast one bibliographyc entry, but we weren't able to find any.</p> -->
		<h3>Create Bibliographic Entry</h3>
	</div>

	<form class="biblio-form horizontal">
		<div class="form-type">						
			<select name="biblio-style" id="biblio-style">
				<option value="mla">MLA</option>
				<option value="chicago">Chicago</option>
				<option value="custom">Custom</option>
			</select>
			<select name="chicago-system" id="chicago-system">
				<option value="notes-and-bibliography">Notes And Bibliography</option>
				<option value="author-date">Author-Date</option>
			</select>
			<select name="type-of-source" id="type-of-source">
				<option value="">type of source</option>
			</select>
			<a href="javascript:;" id="generate-form">generate</a>
		</div>

		<div class="biblio-form-wrapper">
		</div>

		<a href="javascript:;" class="back-button" data-target="biblio-list"></a>


	</form>

</div>