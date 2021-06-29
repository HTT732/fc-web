$(document).ready(function () {
    $('#filter-close').click(function () {
        $('body').removeClass('right-sidebar-active');
    });

    $('#shopSidebar a[type="submit"]').click(function (e) {
        $form = $(this).closest('form').submit();
    });

    $('.filter-by-price li a').click(function () {
        from = $(this).attr('data-from');
        to = $(this).attr('data-to');
        
        $('.filter-by-price li input').remove();

        var input;
        if (from != undefined && to != undefined) {
            input = '<input type="hidden" name="price_min" value="'+from+'">'+
                    '<input type="hidden" name="price_max" value="'+to+'">';
        } else if (from == undefined) {
            input = '<input type="hidden" name="price_max" value="'+to+'">';
        } else {
            input = '<input type="hidden" name="price_min" value="'+from+'">';
        }
        
        $(this).closest('li').append(input)
    });

    $('.sort li a').click(function () {
        sort = $(this).attr('data-sort');
        
        $('.sort li input').remove();

        input = '<input type="hidden" name="sort" value="'+sort+'">';
        
        $(this).closest('li').append(input);
    });

    // delete product popup cart view 
    $('.product-cart .btn-close').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        $product = $(this).closest('.product-cart');
        $cart = $(this).closest('.dropdown-box');

        $.ajax({
            url: url,
            method: 'get'
        })
        .done(function (data) {
            var productPrice = parseInt($product.find('.product-price').html().replace(/,/g, ''));
            var total = parseInt($cart.find('.cart-total .price').html().replace(/,/g, ''));
            var totalCount = $('.header-right .cart-count').html();
            var productCount = $product.find('.product-quantity').html();

            if (total - productPrice == 0) {
                $cart.find('.cart-total').remove();
                $cart.find('.cart-action').remove();
                $cart.find('.products').append('<p class="text-center mt-3">Chưa có sản phẩm</p>');
                $('.header-right .cart-label').html('Giỏ hàng trống');
            } else {
                // set total in product-box 
                $cart.find('.cart-total .price').html(formatPrice(total - productPrice*productCount));

                 // set total, count in header menu
                 $('.header-right .cart-price').html(formatPrice(total - productPrice*productCount));
                
            }

            $('.header-right .cart-count').html(formatPrice(totalCount - productCount));

            // remove product cart
            $product.fadeOut().remove();
        })
        .fail(function (err) {
            console.log(err);
        });
    });

    function formatPrice(price) {
        return new Intl.NumberFormat('ja-JP').format(price);
    }

    // shopping-cart 
    $('.quantity-plus, .quantity-minus').click(function () {
        $product = $(this).closest('tr');
        quanlity = parseInt($product.find('.input-quantity').val());
        price = parseInt($product.find('.product-subtotal span').html().replace(/,/g, ''));

        if ($(this).hasClass('quantity-minus') && quanlity > 1) {
            quanlity -= 1;
            $product.find('.input-quantity').val(quanlity);
            $product.find('.product-price span').html(formatPrice(price * quanlity));
        }

        if ($(this).hasClass('quantity-plus')) {
            quanlity += 1;
            $product.find('.input-quantity').val(quanlity);
            $product.find('.product-price span').html(formatPrice(price * quanlity));
        }

        var oldQuanlity = parseInt($(this).attr('data-quantity'));
        if (quanlity !== oldQuanlity) {
            // enable button update cart 
            $('.btn-cart-update').removeClass('btn-disabled');
        } else {
            $('.btn-cart-update').addClass('btn-disabled');
        }
    });

    // update shopping cart
    $('.btn-cart-update').click(function () {
        $(this).addClass('btn-disabled');
        var data = [];
        var url = $(this).attr('data-url');
        $product = $('.shop-table tbody tr');
        

        $product.each(function () {
            product = {
                order_id: $(this).attr('data-order_id'),
                order_token: $(this).attr('data-token'),
                quanlity: $(this).find('.product-quantity input').val()
            }
            data.push(product);
        });

        // call ajax update 
        $.ajax({
            url: url,
            type: "post",
            data: {
                data: data,
                "_token": $('.shop-table').attr('data-token')
            }
        }).done(function (data) {
            if (data) {
                location.reload();
            }
        }).fail(function () {
            $(".btn-cart-update").notify(
                "Cập nhật giỏ hàng không thành công!", 
                { position:"top" }
            );
            $(".btn-cart-update").removeClass('btn-disabled');
        });
    });

    // product detail 
    $('.single-quantity-minus, .single-quantity-plus').click(function () {
        $product = $(this).closest('.product-qty');
        var qty = parseInt($product.find('input').val());
        var url = $product.find('a').attr('data-url');

        if ($(this).hasClass('single-quantity-minus')) {
            qty = qty > 1 ? qty - 1 : qty;
        } else {
            qty += 1;
        }
        $product.find('input').val(qty);
        $product.find('a').attr('href', url + '/' + qty);
    });
});