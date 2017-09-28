/*
 * This is a sample JavaScript file used by {{ name }}
 *
 */

$(document).on('shown.bs.modal', '.modal', function(event) {

	$(this).find('.image-tags-select').select2({
		theme: 'bootstrap',
		placeholder: 'Insert Tags',
		tags: true,
		tokenSeparators: [',', ' '],
		allowClear: false,
		closeOnSelect: true,
		data: $('.available-tags').data('tags')
	});

	$file_id = $(this).find('input[name="file_id"]').val();

	$(this).find('.img-responsive').cropper({
		viewMode: 1,
		autoCrop: false,
		crop: function(result) {
			$('input[name="crop-x"]').val(result.x);
			$('input[name="crop-y"]').val(result.y);
			$('input[name="crop-width"]').val(result.width);
			$('input[name="crop-height"]').val(result.height);

			console.log(result);
		}
	});

	
})

/**
 * Function used to refresh image preview after crop
 * @param  {[type]} element [description]
 * @param  {[type]} context [description]
 * @param  {[type]} data    [description]
 * @return {[type]}         [description]
 */
function refreshPreview(element, context, data) {
	$containers = $(".upload-object.is-success");
	$container = $containers.filter(function(index) {
		return $(this).data('id') == data.file_id;
	});

	if(data.new_thumb !== null) {
		$($container).find("img").attr('src', data.new_thumb);
	}
}