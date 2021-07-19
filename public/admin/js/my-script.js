$(function () {
    // Hide/show button
    $('tbody').on('click', 'td.dtr-control', function () {
        $this = $(this);
        $tr = $this.closest('tr');

        if ($this.hasClass('details-control')) {
            // This row is already open - close 
            $this.removeClass('details-control');
            $this.addClass('shown');
        } else {
            // Open this row
            $this.removeClass('shown');
            $this.addClass('details-control');
        }
    });

    // Delete product , category, order
    $(document).on('click', '#dataTable .delete-btn', function(e) {
        e.preventDefault();
        $this = $(this)
        id = $this.attr('data-id');
        url = $this.attr('href');
        token = $('#dataTable input[name="_token"]').val();
        tr = $this.closest('tr');
        row = '';

        if (tr.hasClass('child')) {
            row = $('#dataTable').DataTable().row(tr.prev());
        } else {
            row = $('#dataTable').DataTable().row(tr);
        }

        var data = {
            id: id,
            _token: token
        };

        swal({
            title: "Xác nhận xóa?",
            text: "Dữ liệu không thể phục hồi sau khi xóa!",
            icon: "warning",
            buttons: {
                cancel: "Hủy bỏ",
                catch: {
                    text: "Xóa",
                    value: "ok"
                },
            },
        })
        .then((value) => {
            if (value == 'ok') {
                //call ajax
                ajax(data, url).then(function(data){
                    swal('Xóa thành công!', {
                        icon: "success"
                    })
                    row.remove().draw();
                    
                    count = parseInt($('#sidebar-menu .mm-active .badge').html());
                    if (count > 0) {
                        $('#sidebar-menu .mm-active .badge').html(count - 1);
                    }

                }).fail(function(err) {
                    swal('Xóa thất bại!', {
                        icon: "warning"
                    })
                });
            }
        });
    });

    function ajax(data, url) {
        return $.ajax({
            url: url,
            method: 'DELETE',
            data:data,
            sync: true
        });
    }

    // Select file
    $('#uploadBanner').change(function () {
        $this = $(this);
        $this.closest('form').find('p').html('Đã chọn ' + $this.prop('files').length + ' hình ảnh');
    });

    // don't multiple click
    $('.btn-update').on('click',function () {
        $('.loading').removeClass('hide');
        $(this).addClass('disabled', 'disabled');
    })

    // upload avatar
    $('#avatar').on('change', function () {

        url = URL.createObjectURL($('#avatar').prop('files')[0]);
        $('#avatarImg').attr('src', url);
    })

    $('body').on('click', 'input', function () {
        $p = $(this).closest('div').find('p.text-danger');

        if($p.length) {
            $p.empty();
        }
    });

    // Updata process order 
	$(document).on('click', '.process-order', function () {
        var $td = $(this).closest('td');
		var token = $('input[name="_token"]').val();
		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			method:'put',
			data: {_token: token},
			success: function (result) {
				if (result == 1) {
                    var html = '<div class="badge badge-soft-success font-size-12">Đã xử lý</div>'
                    $td.empty();
                    $td.append(html);
                } else {
                    swal('Đã xảy ra lỗi', "", "warning");
                }
			}
		});
	});
});


