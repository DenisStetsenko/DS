<div id="searchModal" class="modal fade" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-body">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</div>
<?php $ajax_nonce = wp_create_nonce( "wp-denstetsenko-key" ); ?>
<script>
	const searchModal 				= document.getElementById('searchModal');
	const searchModalForm			= document.getElementById('ajax-search-form');
	const searchModalInput 		= document.getElementById('s-1');
	const searchModalResults	= document.getElementById('ajax-search-results');
	
	searchModal.addEventListener('shown.bs.modal', event => {
      searchModalInput.focus()
	});
  searchModal.addEventListener('hidden.bs.modal', event => {
      searchModalResults.innerHTML = "";
      searchModalForm.reset();
      searchModalResults.classList.remove("ajax-search-active");
  })
	
  function wp_ajax_live_search(el){
		(function($) {
			var $searchResultsContainer = $('#ajax-search-results');
			var inputTypeChars 					= $(el).val().length;
			var message									= $searchResultsContainer.data('message');
			
			if ( inputTypeChars > 1 ) {
				$.ajax({
					url			 : '<?= admin_url('admin-ajax.php'); ?>',
					dataType : "json",
					type		 : 'post',
					cache    : false,
					context  : this,
					data: {
						action	 	: 'wp_ajax_live_search_data_fetch',
						keyword		: $('#s-1').val(),
						security  : '<?php echo $ajax_nonce; ?>'
					},
					success: function( result ) {

              console.log(result.data.args);
              
						var $searchResults = $(result.data.html);
						$searchResultsContainer
								.css({ opacity: 0 })
								.addClass('ajax-search-active')
								.html( $searchResults )
								.animate({ opacity: 1 }, 200);
					}
				});
			}
			else {
				$searchResultsContainer.html('<li class="list-item">' + message + '</li>');
			}
			
		}(jQuery));
  }
	
</script>