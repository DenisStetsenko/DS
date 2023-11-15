<?php if ( ! is_404() ) : ?>
<div id="searchModal" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-body">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php $ajax_nonce = wp_create_nonce( "wp-denstetsenko-key" ); ?>
<script data-cfasync="false" data-wpfc-render=”false”>
	const searchModal 				= document.getElementById('searchModal');
	const searchModalForm			= document.getElementById('ajax-search-form');
	const searchModalInput 		= document.getElementById('the-s-1');
	const searchModalResults	= document.getElementById('ajax-search-results');
	
	<?php if ( ! is_404() ) : ?>
	searchModal.addEventListener('shown.bs.modal', event => {
      searchModalInput.focus()
	});
  searchModal.addEventListener('hidden.bs.modal', event => {
      searchModalResults.innerHTML = "";
      searchModalForm.reset();
      searchModalResults.classList.remove("ajax-search-active");
  })
	<?php endif; ?>
  function wp_ajax_live_search(el){
		(function($) {
			let $searchResultsContainer = $('#ajax-search-results');
			let inputTypeChars 					= $(el).val().length;
			let message									= $searchResultsContainer.data('message');
			let error										= $searchResultsContainer.data('error');
			
			if ( inputTypeChars > 1 ) {
				$.ajax({
					url			 : '<?= admin_url('admin-ajax.php'); ?>',
					dataType : "json",
					type		 : 'POST',
					cache    : false,
					context  : this,
					data: {
						action	 	: 'wp_ajax_live_search_data_fetch',
						keyword		: $('#the-s-1').val(),
						security  : '<?php echo $ajax_nonce; ?>'
					},
					error: function (xhr, ajaxOptions, thrownError) {
						$searchResultsContainer.html('<li class="list-item font-secondary text-danger text-center text-danger dd">'+ error +'</li>').addClass('ajax-search-active');
					},
					success: function( result ) {
						if ( result.success ) {
							let $searchResults = $(result.data.html);
								
							if ( result.data.found > 0 ) {
								$searchResultsContainer
									.css({ opacity: 0 })
									.removeClass('ajax-search-error')
									.addClass('ajax-search-active')
									.html( $searchResults )
									.animate({ opacity: 1 }, 200);
							} else {
								$searchResultsContainer.removeClass('ajax-search-active').addClass('ajax-search-error').html( $searchResults );
							}
                
						} else {
							$searchResultsContainer.removeClass('ajax-search-active').addClass('ajax-search-error').html('<li class="list-item font-secondary text-danger text-center ss">'+ error +'</li>');
						}
					}
				});
			} else {
				$searchResultsContainer.addClass('ajax-search-error').html('<li class="list-item font-secondary text-center text-danger bb">' + message + '</li>');
			}
			
			return false;
		}(jQuery));
  }
	
</script>