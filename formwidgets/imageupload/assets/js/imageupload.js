/*
 * This is a sample JavaScript file used by {{ name }}
 *
 * You can delete this file if you want
 */

$(document).on('shown.bs.modal', '.modal', function(event) {
	console.log($('.available-tags').data('tags'));
	$(this).find('.image-tags-select').select2({
		placeholder: 'Insert Tags',
		tags: true,
		tokenSeparators: [',', ' '],
		allowClear: true,
		closeOnSelect: false,
		data: $('.available-tags').data('tags')
	});
	$file_id = $(this).find('input[name="file_id"]').val();
	$(this).find('.img-responsive').cropper({
		viewMode: 1,
		autoCrop: true,
		crop: function(result) {
			$crop_info = {'x': result.x, 'y': result.y, 'width': result.width, 'height': result.height, 'file_id': $file_id}
		}
	});

	
})

function cropImage(element) {
	$.request('onImageCrop', {
		data: $crop_info,
		redirect: '#cropImage',
		success: function(data) {

			var date = new Date();
			$new_url = data.url + '?' + date.getTime();

			$cropper_canvas = $('.cropper-canvas').find('img');
			$cropper_view_box = $('.cropper-view-box').find('img');

			$($cropper_canvas).attr('src', $new_url);
			$($cropper_view_box).attr('src', $new_url);

			console.log(data);

			console.log($('img[data-dz-thumbnail][src="' + data.thumb_url + '"]'));
		}
	});
}