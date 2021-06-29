// Upload img "add product/ edit product"
let data = [];
let check = false;
let $form = null;
$(function () {
	$form = $('.add-form');

	if($('#editProductForm').length) {
		check = true;
	}

	var dropZone = Dropzone.forElement("#mydropzone");
	dropZone.on('success', function (file, path) {
		check = true;
		data.push(path);
	})

	dropZone.on('error', function () {
		swal("Tải lên hình ảnh bị lỗi, vui lòng thử lại","", "warning");
	})

	// submit
	$('#submit').click(function () {
		$(window).off('beforeunload');

		for (i = 0; i < data.length; i++) {
			pathMedium = "<input type='hidden' name='medium[]' value='"+data[i].medium+"'/>";
			pathLarge = "<input type='hidden' name='large[]' value='"+data[i].large+"'/>";
			pathSmall = "<input type='hidden' name='small[]' value='"+data[i].small+"'/>";
			$form.append(pathMedium);
			$form.append(pathLarge);
			$form.append(pathSmall);
		}

		if (!check) {
			swal("Hãy chọn ít nhất một hình ảnh","", "warning");
			return false;
		}
		$('#btnSubmit').click();

	})

	$(window).bind('beforeunload', function () {
		var url = $('#deleteRoute').val();
		var token = $('input[name="_token"]').val();

		$.ajax({
			url: url,
			type: 'post',
			data: {data: data, _token: token}
		});
	});

	$('.remove-image').on('click', function () {
		$this = $(this);
		var id = $this.attr('data-id');
		var html = '<input type="hidden" name="picture_id[]" value="'+id+'">';
		$form.append(html);
		$this.closest('div').fadeOut().remove();
	});
})

