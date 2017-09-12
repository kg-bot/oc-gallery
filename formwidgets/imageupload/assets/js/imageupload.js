/*
 * This is a sample JavaScript file used by {{ name }}
 *
 * You can delete this file if you want
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
		movable: false,
		rotatable: false,
		scalable: false,
		zoomable: false,
		crop: function(result) {
			$('input[name="crop-x"]').val(result.x);
			$('input[name="crop-y"]').val(result.y);
			$('input[name="crop-width"]').val(result.width);
			$('input[name="crop-height"]').val(result.height);

			console.log(result);
		}
	});

	
})

/*
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
}*/