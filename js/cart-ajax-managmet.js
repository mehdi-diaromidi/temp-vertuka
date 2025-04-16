jQuery(document).ready(function ($) {
  // $('#md-empty-cart-button').on('click', function (e) {
  //   e.preventDefault();

  //   var nonce = $(this).data('nonce');

  //   var button = $(this);
  //   var spinner = button.find('.emty-cart-spinner');
  //   var differentiator = button.data('attr-diff');
  //   var container = $('.cart-content');
  //   $.ajax({
  //     url: wc_cart_params.ajax_url,
  //     type: 'POST',
  //     data: {
  //       action: 'custom_empty_cart',
  //       security: nonce,
  //     },
  //     beforeSend: function () {
  //       spinner.fadeIn(500, function () {
  //         $(this).removeClass('d-none').removeClass('low-opacity');
  //       });
  //     },
  //     success: function (response) {
  //       if (response.success) {
  //         if (differentiator == 'cart') {
  //           spinner.fadeOut(500, function () {
  //             $(this).addClass('d-none');
  //           });
  //           button.addClass('empty-cart-fade-out');
  //           container.fadeOut(1000, function () {
  //             $(this).html(`
  //             <div class="cart-content">
  //                 <div class="woocommerce">
  //                   <p class="mt-4 text-center">
  //                     محصولات موجود در سبد خرید شما با موفقیت حذف شدند.
  //                   </p>
  //                   <p class="return-to-shop text-center">
  //                     <a class="button wc-backward" href="/">
  //                             بازگشت به فروشگاه
  //                     </a>
  //                   </p>
  //                 </div>
  //             </div>
  //           `);
  //             $(this).fadeIn(1000);
  //           });

  //           $('.whole-item-count').text('0');
  //           if ($('#vertuka-all-discounted').length) {
  //             $('#vertuka-all-discounted').css('display', 'none');
  //           }
  //           if ($('div.mb-1 > div:nth-child(1)').length) {
  //             $('div.mb-1 > div:nth-child(1)').css('display', 'none');
  //           }
  //           $('.woocommerce-Price-amount').html('0&nbsp;<span class="woocommerce-Price-currencySymbol">تومان </span>');
  //           $('.wc-proceed-to-checkout a.checkout-button').attr('href', '/').text('بازگشت به فروشگاه');
  //           // alert(response.datTESa.message);
  //         } else {
  //           alert(response.data.message);
  //         }
  //       } else if (differentiator == 'checkout') {
  //         window.location.href = 'https://vertuka.com/cart/';
  //       }
  //     },
  //     error: function () {
  //       alert('خطایی رخ داد، لطفا بعدا دوباره تلاش کنید ');
  //     },
  //     complete: function () {},
  //   });
  // });
  $('#remove-single-product-minicart').on('click', function (e) {
    e.preventDefault();

    var button = $(this);
    var container = button.closest('.cart-product-item');
    var crossIcon = container.find('.emty-cart-icon-single');
    var spinner = container.find('.emty-cart-circle-loader');

    crossIcon.fadeOut(500, function () {
      $(this).addClass('d-none');
    });

    spinner.fadeIn(500, function () {
      $(this).removeClass('d-none');
    });

    var productId = button.data('product_id');
    var nonce = button.data('nonce');

    $.ajax({
      type: 'POST',
      url: wc_cart_params.ajax_url,
      data: {
        action: 'empty_cart_single_ajax',
        product_id: productId,
        nonce: nonce + 1,
      },
      success: function (response) {
        if (response.success) {
          $(document.body).trigger('updated_wc_div');
          statusChange('success');
          container.delay(300).slideUp(700, function () {
            $(this).addClass('d-none');
          });

          // alert('Product removed successfully');
        } else {
          alert('Error: ' + response.data);
          // statusChange('failed');
        }
      },
      error: function (error) {
        statusChange('failed');
        console.log('AJAX Error:', error);
      },
    });

    function statusChange(status) {
      spinner.removeClass().addClass('emty-cart-circle-loader ' + status);
    }
  });

  // $('#md-emty-cart-minicart').on('click', function (e) {
  //   e.preventDefault();

  //   const button = $(this);
  //   const nonce = button.data('nonce'); // باید مطابق با wp_create_nonce باشد
  //   const spinner = button.find('.emty-cart-spinner');
  //   const container = $('.cart-details');

  //   if (!nonce) {
  //     console.error('❌ نانس یافت نشد!');
  //     return;
  //   }

  //   $.ajax({
  //     url: 'https://testmd.vertuka.com/wp-admin/admin-ajax.php', // آدرس هاردکد شده
  //     type: 'POST',
  //     data: {
  //       action: 'empty_minicart_nonce',
  //       security: nonce,
  //     },
  //     beforeSend: () => spinner.fadeIn(500).removeClass('d-none'),
  //     success: (response) => {
  //       if (response.success) {
  //         container.slideUp(500, () => {
  //           container.html('<div class="cart-empty">سبد خرید خالی شد.</div>').slideDown(500);
  //         });
  //       } else {
  //         alert(`خطا: ${response.data}`);
  //       }
  //     },
  //     error: (jqXHR) => {
  //       console.error('خطای سرور:', jqXHR.responseText);
  //       alert('خطایی رخ داد، لطفاً دوباره تلاش کنید.');
  //     },
  //     complete: () => spinner.fadeOut(500),
  //   });
  // });

  // اضافه کردن رویداد کلیک به دکمه با ID x
  $('#md-emty-cart-minicart').on('click', function (e) {
    var button = $(this);
    var spinner = button.find('.emty-cart-spinner');
    var container = $('.cart-details');

    e.preventDefault();
    $.ajax({
      url: wc_cart_params.ajax_url,
      type: 'POST',
      data: {
        action: 'empty_minicart_nonce',
      },
      success: (response) => {
        if (response.success) {
          container.slideUp(500, () => {
            container.html('<div class="cart-empty">سبد خرید خالی شد.</div>').slideDown(500);
          });
        } else {
          alert(`خطا: ${response.data}`);
        }
      },
      error: (jqXHR) => {
        console.error('خطای سرور:', jqXHR.responseText);
        alert('خطایی رخ داد، لطفاً دوباره تلاش کنید.');
      },
      complete: () => spinner.fadeOut(500),
    });
  });

  $('#md-empty-cart-button').on('click', function (e) {
    e.preventDefault();
    alert(wc_empty_cart_params.ajax_url);
    alert(wc_empty_cart_params.nonce);

    var button = $(this);
    var spinner = button.find('.emty-cart-spinner');
    var differentiator = button.data('attr-diff');
    var container = $('.cart-content');
    $.ajax({
      url: wc_empty_cart_params.ajax_url,
      type: 'POST',
      data: {
        action: 'empty_cart_ajax',
        // _nonce: wc_empty_cart_params.nonce,
      },
      beforeSend: function () {
        spinner.fadeIn(500, function () {
          $(this).removeClass('d-none').removeClass('low-opacity');
        });
      },
      success: function (response) {
        if (response.success) {
          if (differentiator == 'cart') {
            spinner.fadeOut(500, function () {
              $(this).addClass('d-none');
            });
            button.addClass('empty-cart-fade-out');
            container.fadeOut(1000, function () {
              $(this).html(`
              <div class="cart-content">
                  <div class="woocommerce">
                    <p class="mt-4 text-center">
                      محصولات موجود در سبد خرید شما با موفقیت حذف شدند.
                    </p>
                    <p class="return-to-shop text-center">
                      <a class="button wc-backward" href="/">
                              بازگشت به فروشگاه
                      </a>
                    </p>
                  </div>
              </div>
            `);
              $(this).fadeIn(1000);
            });

            $('.whole-item-count').text('0');
            if ($('#vertuka-all-discounted').length) {
              $('#vertuka-all-discounted').css('display', 'none');
            }
            if ($('div.mb-1 > div:nth-child(1)').length) {
              $('div.mb-1 > div:nth-child(1)').css('display', 'none');
            }
            $('.woocommerce-Price-amount').html('0&nbsp;<span class="woocommerce-Price-currencySymbol">تومان </span>');
            $('.wc-proceed-to-checkout a.checkout-button').attr('href', '/').text('بازگشت به فروشگاه');
            // alert(response.datTESa.message);
          } else {
            alert(response.data.message);
          }
        } else if (differentiator == 'checkout') {
          window.location.href = 'https://vertuka.com/cart/';
        }
      },
      error: function () {
        console.error('خطای سرور:', jqXHR.responseText);
        alert('خطایی رخ داد، لطفاً دوباره تلاش کنید.');
      },
      complete: function () {},
    });
  });
});
