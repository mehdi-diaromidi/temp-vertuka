(function ($) {
  ('use strict');
  jQuery(document).ready(function ($) {
    // Slider
    $('.slider-box .owl-carousel').owlCarousel({
      loop: true,
      rtl: true,
      margin: 2,
      dots: true,
      responsiveClass: true,
      autoplay: true,
      autoplayTimeout: 5000,
      responsive: {
        0: {
          items: 1,
        },
        600: {
          items: 1,
        },
        1000: {
          items: 1,
        },
      },
    });

    // Off section Carousel
    $('.off-products-section .owl-carousel').owlCarousel({
      rtl: true,
      loop: true,
      margin: 0,
      nav: true,
      dots: false,
      autoplay: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: false,
      navText: ["<span class='owl-arrow-navbar-btn previous' aria-label='Previous'><i class='icon right-arrow'></i></span>", "<span class='owl-arrow-navbar-btn next' aria-label='Next'><i class='icon left-arrow-2'></i></span>"],

      responsive: {
        0: {
          items: 2,
        },
        768: {
          items: 3,
        },
        992: {
          items: 6,
        },
      },
    });

    // product Category Carousel
    $('.product-category-section .owl-carousel').owlCarousel({
      rtl: true,
      loop: true,
      margin: 24,
      nav: false,
      dots: false,
      responsive: {
        0: {
          items: 3,
        },
        768: {
          items: 4,
        },
        992: {
          items: 6,
        },
      },
    });

    // Gallery Carousel
    $('.gallery .owl-carousel').owlCarousel({
      rtl: true,
      loop: false,
      margin: 4,
      nav: false,
      responsive: {
        0: {
          items: 4,
        },
        768: {
          items: 4,
        },
        992: {
          items: 5,
        },
      },
    });

    /**
     * Expand Text box
     */
    $('.about-shop-section #vertuka-show-more').on('click', function () {
      $('.about-shop-section #about-shop-section-text').toggleClass('active');

      if ($(this).text() == 'بستن') {
        $(this).text('ادامه مطلب');
      } else {
        $(this).text('بستن');
      }
    });

    // defult gradient
    $('.about-product-section p').addClass('bottom-gradient');
    $('.about-product-section .vertuka-show-more').on('click', function () {
      $('.about-product-section #about-product-section-text').toggleClass('active');
      if ($(this).text() == 'بستن') {
        $(this).text('ادامه مطلب');
        //add gradient
        $('.about-product-section p').addClass('bottom-gradient');
      } else {
        $(this).text('بستن');
        //remove gradient
        $('.about-product-section p').removeClass('bottom-gradient');
      }
    });
    $('.about-tech-product-section .vertuka-show-more').on('click', function () {
      $('.about-tech-product-section #about-tech-product-section-text').toggleClass('active');
      if ($(this).text() == 'بستن') $(this).text('ادامه مطلب');
      else $(this).text('بستن');
    });

    /**
     * Vertuka Checkbox
     */
    $('.vertuka-checkbox').on('click', function () {
      $(this).toggleClass('active');
      if ($('.mj-hoghoghy-force').text() != 'no') {
        $('.mj-hoghoghy-force').removeClass('d-none');
        $(this).toggleClass('active');
      }
    });

    /**
     * Vertuka Checkbox for insurance
     */
    $('.vertuka-insurance-option .vertuka-checkbox').on('click', function () {
      const vertuka_checkbox = $(this);

      // Check/uncheck the actual checkbox based on the presence of 'active' class
      $('#13-f_________-______________').prop('checked', $(this).hasClass('active')).change();
      //$("#yith-wapo-4-0").prop("checked", $(this).hasClass("active")).change();

      if ($(this).hasClass('active')) {
        $('.ppom-total-without-fixed').css('display', 'block');
      } else {
        $('.ppom-total-without-fixed').css('display', 'none');
      }
    });

    $('#13-f_________-______________').prop('checked', 'checked').change();

    /**
     * Vertuka Checkbox for Haghighi or hoghooghi
     */
    $('.cart-box #vertuka-order-type .vertuka-insurance-option .vertuka-checkbox').on('click', function () {
      // Check the appropriate radio button based on the 'active' class
      if ($(this).hasClass('active')) {
        $('.express-cart-price-box #vertuka_custom_radio_field_hoghooghi').prop('checked', true);
        $('.express-cart-price-box #vertuka_custom_radio_field_haghighi').prop('checked', false);
      } else {
        $('.express-cart-price-box #vertuka_custom_radio_field_hoghooghi').prop('checked', false);
        $('.express-cart-price-box #vertuka_custom_radio_field_haghighi').prop('checked', true);
      }
    });

    /**
     * Vertuka Select Color Option on product single page
     */
    $('.color-option.enable').on('click', function () {
      //   MJ release selected guarantee
      $('.variations_form .variations #pa_guarantee').val(0).change();
      $('.fix-text-guarantee').text('');

      const option = $(this);
      $('.color-option').removeClass('active');
      option.addClass('active');

      const id = option.attr('id');
      $('#pa_color').val(id).change();

      const activeText = option.find('.text').text();
      const activecolor = option.find('.color').css('background');

      $('.express-buy ul > li .express-color').css('background', activecolor);
      $('.express-buy ul > li .express-text').text(activeText);

      //  MJ if color changed
      //  jQuery('.variations_form').clone().appendTo('#mj-guarantee');
      $('#mj-guarantee').empty();
      $('#mj-guarantee').append('<h3>گارانتی: </h3>');
      $('table #pa_guarantee').clone().appendTo('#mj-guarantee');
      $('#mj-guarantee #pa_guarantee').addClass('mj-guarantee-select form-select');
      // auto select garanty after color changed
      $('#mj-guarantee .mj-guarantee-select').val($('#mj-guarantee .mj-guarantee-select option:eq(1)').val());
      $('#mj-guarantee .mj-guarantee-select').trigger('change');

      $('#mj-guarantee-mob').empty();
      $('#mj-guarantee-mob').append('<h3>گارانتی: </h3>');
      $('table #pa_guarantee').clone().appendTo('#mj-guarantee-mob');
      $('#mj-guarantee-mob #pa_guarantee').addClass('mj-guarantee-select form-select');
      // auto select garanty after color changed
      $('#mj-guarantee-mob .mj-guarantee-select').val($('#mj-guarantee-mob .mj-guarantee-select option:eq(1)').val());
      $('#mj-guarantee-mob .mj-guarantee-select').trigger('change');

      // change free shipping text

      if (parseInt($('div.woocommerce-variation-price.numb > span > span > bdi').text().replace('تومان', '')) > 5000000) {
        $('div.option-to-buy.pb-2.d-none.d-lg-block > div > ul > li.d-flex.mj_popup_shipping > div:nth-child(2) > p').html('ارسال رایگان ' + '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"></path></svg>');
        $('div.product-info > div.py-5.bg-white.mobile-option-to-buy > div > div:nth-child(2) > div > ul > li.d-flex.mj_popup_shipping > div:nth-child(2) > p').html('ارسال رایگان ' + '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"></path></svg>');
      } else {
        $('div.option-to-buy.pb-2.d-none.d-lg-block > div > ul > li.d-flex.mj_popup_shipping > div:nth-child(2) > p').html('ارسال توربو ' + '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"></path></svg>');
        $('div.product-info > div.py-5.bg-white.mobile-option-to-buy > div > div:nth-child(2) > div > ul > li.d-flex.mj_popup_shipping > div:nth-child(2) > p').html('ارسال توربو ' + '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"></path></svg>');
      }
    });

    // MJ if mj-guarantee-select changed
    $(document).on('change', '.mj-guarantee-select', function () {
      $('.variations_form .variations #pa_guarantee').val($(this).val()).change();

      $('.fix-text-guarantee').text($('#mj-guarantee .mj-guarantee-select option:selected').text());

      $('.namojod').remove();
      $('#single_add_to_cart_button-2').prop('disabled', false);
    });

    function vertuka_color_picker_def() {
      var first_choice = $('div.vertuka-option-var:nth-child(1) .color-option');
      if (first_choice.hasClass('disable')) {
        first_choice = $('div.vertuka-option-var:nth-child(2) .color-option');
        if (first_choice.hasClass('disable')) {
          first_choice = $('div.vertuka-option-var:nth-child(3) .color-option');
          if (first_choice.hasClass('disable')) {
            first_choice = $('div.vertuka-option-var:nth-child(4) .color-option');
            if (first_choice.hasClass('disable')) {
              first_choice = $('div.vertuka-option-var:nth-child(5) .color-option');
            }
          }
        }
      }

      first_choice.addClass('active');
      $('#pa_color').val(first_choice.attr('id')).change();

      $('.express-buy ul > li .express-color').css('background', first_choice.find('.color').css('background'));
      $('.express-buy ul > li .express-text').text(first_choice.find('.text').first().text());
    }
    // vertuka_color_picker_def();

    /**
     * Vertuka Quantity input : decrease
     */
    function vertuka_handle_local_quanity_decrease(btn) {
      var local_quantity = btn.closest('.cart-product-item').find('.quantity .qty');
      let local_quantity_txt = btn.closest('.quantity').find('.numb');
      var old_val = local_quantity.val();
      var new_val = parseInt(old_val) - 1;
      local_quantity.val(new_val);
      local_quantity_txt.text(new_val);
    }
    //for single product
    $('.buy-section .vertuka-q-input .decrease').on('click', function () {
      const btn = $(this);
      var local_quantity = $('.buy-section input[name=quantity].qty');
      const max_val = parseInt(local_quantity.attr('max'));
      const min_val = parseInt(local_quantity.attr('min'));
      var old_val = local_quantity.val();
      var new_val = parseInt(old_val) - 1;

      if (!(new_val < 1)) {
        let local_quantity_txt = btn.closest('.quantity').find('.numb');
        local_quantity.val(new_val);
        local_quantity_txt.text(new_val);

        local_quantity.val(new_val).trigger('change');
      }
    });
    // for cart header
    $('.cart-details .vertuka-q-input .decrease').on('click', function () {
      const btn = $(this);

      var local_quantity = btn.closest('.cart-product-item').find('.quantity .qty');
      const max_val = parseInt(local_quantity.attr('max'));
      const min_val = parseInt(local_quantity.attr('min'));
      var old_val = local_quantity.val();
      var new_val = parseInt(old_val) - 1;

      if (!(new_val > max_val)) {
        if (old_val == 1) {
          var local_quantity = btn.closest('.cart-product-item').find('.price-box').find('.position-relative').find('.remove-item i').trigger('click');
        } else {
          vertuka_handle_local_quanity_decrease(btn);
          local_quantity.val(new_val).trigger('change');
          $('.cart-details .vertuka-update-button').removeAttr('disabled').click();
        }
      }
    });
    //for cart page
    $('.cart-box .cart-content .vertuka-q-input .decrease').on('click', function () {
      MJ_popup_function();

      const btn = $(this);

      var local_quantity = btn.closest('.cart-product-item').find('.quantity .qty');
      const max_val = parseInt(local_quantity.attr('max'));
      const min_val = parseInt(local_quantity.attr('min'));
      var old_val = local_quantity.val();
      var new_val = parseInt(old_val) - 1;

      // console.log(max_val, old_val, new_val);

      if (!(new_val > max_val)) {
        vertuka_handle_local_quanity_decrease(btn);
        local_quantity.val(new_val).trigger('change');
        btn.closest('.cart-product-item').find('.vertuka-update-button').removeAttr('disabled').click();
      }
    });

    /**
     * Vertuka Quantity input : Increase
     */
    function vertuka_handle_local_quanity_increase(btn) {
      let local_quantity = btn.closest('.quantity').find('input[name=quantity]');
      let local_quantity_txt = btn.closest('.quantity').find('.numb');

      var old_val = local_quantity.val();
      var new_val = parseInt(old_val) + 1;

      local_quantity.val(new_val);
      local_quantity_txt.text(new_val);
    }
    // for single product
    $('.buy-section .vertuka-q-input .increase').on('click', function () {
      const btn = $(this);
      var local_quantity = $('.buy-section input[name=quantity].qty');
      const max_val = parseInt(local_quantity.attr('max'));

      const min_val = parseInt(local_quantity.attr('min'));
      var old_val = local_quantity.val();
      var new_val = parseInt(old_val) + 1;

      if (!(new_val > max_val)) {
        vertuka_handle_local_quanity_increase(btn);
        local_quantity.val(new_val).trigger('change');
      }
    });
    //for header cart
    $('.cart-details .vertuka-q-input .increase').on('click', function () {
      const btn = $(this);

      var local_quantity = btn.closest('.cart-product-item').find('.quantity .qty');
      const max_val = parseInt(local_quantity.attr('max'));
      const min_val = parseInt(local_quantity.attr('min'));
      var old_val = local_quantity.val();
      var new_val = parseInt(old_val) + 1;

      if (!(new_val > max_val)) {
        vertuka_handle_local_quanity_increase(btn);
        local_quantity.val(new_val).trigger('change');
        btn.closest('.cart-product-item').find('.vertuka-update-button').removeAttr('disabled').click();
      }
    });
    //for cart page
    $('.cart-box .cart-content .vertuka-q-input .increase').on('click', function () {
      const btn = $(this);

      var local_quantity = btn.closest('.cart-product-item').find('.quantity .qty');

      const max_val = parseInt(local_quantity.attr('max'));

      const min_val = parseInt(local_quantity.attr('min'));
      var old_val = local_quantity.val();
      var new_val = parseInt(old_val) + 1;

      if (max_val == 1) {
        MJ_popup_function_only_one();
      }

      if (!(new_val > max_val) && max_val > 1) {
        MJ_popup_function();

        vertuka_handle_local_quanity_increase(btn);
        local_quantity.val(new_val).trigger('change');
        btn.closest('.cart-product-item').find('.vertuka-update-button').removeAttr('disabled').click();
      }
    });
    /* for mobile */
    $('.vertuka-q-input.mobile-qty').on('click', '.increase', function () {
      $(this).closest('.item-box').find('.cart-product-item').find('.quantity').find('.vertuka-q-input').find('.increase').click();
    });

    $('.vertuka-q-input.mobile-qty').on('click', '.decrease', function () {
      $(this).closest('.item-box').find('.cart-product-item').find('.quantity').find('.vertuka-q-input').find('.decrease').click();
    });

    /**
     * expand image & lightbox for products & footer license
     */
    $('.full-screen #vertuka-expand').on('click', function () {
      const src = $('.product-page .product-image-gallery .image-box .product-image > img').attr('src');
      const modal = $('.vertuka-image-modal');
      const modal_img = $('.vertuka-image-modal > .modal-content');

      modal.css('display', 'block');
      modal_img.attr('src', src);
    });
    //MJ separate product from footer
    $('.full-screen #MJ-pro-vertuka-expand, #vertuka-main-product-image > img').on('click', function () {
      const src = $('.product-page .product-image-gallery .image-box .product-image > img').attr('src');
      const modal = $('.MJ-pro-vertuka-image-modal');
      const modal_img = $('.MJ-pro-vertuka-image-modal > .modal-content');

      modal.css('display', 'block');
      modal_img.attr('src', src);
    });

    $('.MJ-pro-vertuka-image-modal .close').on('click', function () {
      $('.MJ-pro-vertuka-image-modal').css('display', 'none');
    });

    $('.MJ-pro-vertuka-image-modal .MJ-next-button').on('click', function () {
      let vertuka_product_img_src = $('#MJ-pro-vertuka-image-modal > img').attr('src');
      let vertuka_product_current_img_id = $('.product-page .product-image-gallery .gallery img[src="' + vertuka_product_img_src + '"]')
        .closest('.item')
        .attr('id');

      var id = 0;
      if (parseInt(vertuka_product_current_img_id.replace('item-', '')) + 1 > $('.product-page .product-image-gallery .gallery img').length - 2) {
        id = 1;
      } else {
        id = parseInt(vertuka_product_current_img_id.replace('item-', '')) + 1;
      }

      let vertuka_product_new_img_id = '#item-' + id;
      let vertuka_new_img_src = $(vertuka_product_new_img_id + ' img').attr('src');
      // $('.product-page .product-image-gallery .image-box .product-image > img').attr('src', vertuka_new_img_src);

      const src = vertuka_new_img_src;
      const modal = $('.MJ-pro-vertuka-image-modal');
      const modal_img = $('.MJ-pro-vertuka-image-modal > .modal-content');

      modal.css('display', 'block');
      modal_img.attr('src', src);
    });

    $('.MJ-pro-vertuka-image-modal .MJ-prev-button').on('click', function () {
      let vertuka_product_img_src = $('#MJ-pro-vertuka-image-modal > img').attr('src');
      let vertuka_product_current_img_id = $('.product-page .product-image-gallery .gallery img[src="' + vertuka_product_img_src + '"]')
        .closest('.item')
        .attr('id');
      var id;
      if (parseInt(vertuka_product_current_img_id.replace('item-', '')) - 1 == 0) {
        id = $('.product-page .product-image-gallery .gallery img').length - 2;
      } else {
        id = parseInt(vertuka_product_current_img_id.replace('item-', '')) - 1;
      }
      let vertuka_product_new_img_id = '#item-' + id;
      let vertuka_new_img_src = $(vertuka_product_new_img_id + ' img').attr('src');
      // $('.product-page .product-image-gallery .image-box .product-image > img').attr('src', vertuka_new_img_src);

      const src = vertuka_new_img_src;
      const modal = $('.MJ-pro-vertuka-image-modal');
      const modal_img = $('.MJ-pro-vertuka-image-modal > .modal-content');

      modal.css('display', 'block');
      modal_img.attr('src', src);
    });

    $('.MJ-pro-vertuka-image-modal').click(function (e) {
      if (e.target.id == 'MJ-pro-vertuka-image-modal') {
        $('.MJ-pro-vertuka-image-modal').css('display', 'none');
      }
    });
    $('body').click(function (e) {
      if (e.target.className == 'MJ-next-button' || e.target.className == 'MJ-prev-button' || e.target.id == 'MJ-next-button-left' || e.target.id == 'MJ-prev-button-right') {
        // MJ okay
      } else {
        // if ($(e.target.className == 'MJ-pro-vertuka-image-modal')) {
        //     $('.MJ-pro-vertuka-image-modal').css('display', 'none');
        // }
      }
    });

    //MJ end
    $('.footer #vertuka-image-modal:not(.modal-content)').click(function () {
      $('.vertuka-image-modal').css('display', 'none');
    });

    /**
     * Lightbox for footer
     */
    $('.footer .bottom-section .license.popup').on('click', function () {
      const src = $(this).attr('data-vertuka-popup');
      // console.log(src);
      const modal = $('.vertuka-image-modal');
      const modal_img = $('.vertuka-image-modal > .modal-content');

      modal.css('display', 'block');
      modal_img.attr('src', src);
    });

    /**
     * Navigate Product Thumbnails
     */
    let mehdi_counter = 0;
    let vertuka_product_img_src;
    if ($('#vertuka-main-product-image .next-button').length > 0) {
      $('#vertuka-main-product-image .next-button').on('click', function () {

        if (mehdi_counter == 0) {
          let vertuka_product_img_src = $('a.vertuka-product-thumbnail-gallery > img').attr('src');
          mehdi_counter = mehdi_counter + 1;
        } else {
          let vertuka_product_img_src = $('vertuka-product-thumbnail-gallery > img').attr('src');
        }

        let vertuka_product_current_img_id = $('.product-page .product-image-gallery .gallery img[src="' + vertuka_product_img_src + '"]')
          .closest('.item')
          .attr('id');

        var id = 0;
        if (parseInt(vertuka_product_current_img_id.replace('item-', '')) + 1 > $('.product-page .product-image-gallery .gallery img').length - 2) {
          id = 1;
        } else {
          id = parseInt(vertuka_product_current_img_id.replace('item-', '')) + 1;
        }

        let vertuka_product_new_img_id = '#item-' + id;
        let vertuka_new_img_src = $(vertuka_product_new_img_id + ' img').attr('src');
        $('.product-page .product-image-gallery .image-box .product-image > img').attr('src', vertuka_new_img_src);
      });

      $('#vertuka-main-product-image .prev-button').on('click', function () {
        let vertuka_product_img_src = $('#vertuka-main-product-image > img').attr('src');
        let vertuka_product_current_img_id = $('.product-page .product-image-gallery .gallery img[src="' + vertuka_product_img_src + '"]')
          .closest('.item')
          .attr('id');
        var id;
        if (parseInt(vertuka_product_current_img_id.replace('item-', '')) - 1 == 0) {
          id = $('.product-page .product-image-gallery .gallery img').length - 2;
        } else {
          id = parseInt(vertuka_product_current_img_id.replace('item-', '')) - 1;
        }
        let vertuka_product_new_img_id = '#item-' + id;
        let vertuka_new_img_src = $(vertuka_product_new_img_id + ' img').attr('src');
        $('.product-page .product-image-gallery .image-box .product-image > img').attr('src', vertuka_new_img_src);
      });
    }

    /**
     * Change image when click in product
     */
    $('.vertuka-product-thumbnail-gallery > img').on('click', function () {
      const new_src = $(this).attr('src');
      $('.product-page .product-image-gallery .image-box .product-image > img').attr('src', new_src);
    });

    /**
     * Temporary oage
     */
    $('.temporary-page table').addClass('table-bordered');

    // Sort order button
    $('#sort-product-by a').on('click', function () {
      const id = $(this).attr('id');
      const selector = '#' + id;
      $('.orderby').val(id).change();
    });

    // Filter button
    $('.yith-wcan-filters-opener').text('فیلتر');
    $('.yith-wcan-filters.filters-modal h3.mobile-only').text('فیلتر');
    $('.apply-filters.main-modal-button').text('اعمال تغییرات');
    $('#filter_1073_0 > h4:nth-child(1)').html('دسته&zwnj;بندی محصولات');
    $('.woocommerce-MyAccount-content > p:nth-child(2)').html('آدرس&zwnj;هایی که اخیرا از آن استفاده کرده اید');

    // Secondary add to cart button
    $('.single_add_to_cart_button-2').on('click', function () {
      $('form.variations_form').submit();
    });

    $('.show-more-to-buy').on('click', function () {
      const show_more = $(this);
      show_more.toggleClass('active');
      show_more.find('.icon').toggleClass('active');
      $('.section-buyer-single').toggleClass('active');
    });

    //Filter
    // Initially, show all cards
    $('.filter-item').show();
    $('div.d-lg-flex.justify-content-between.mt-4 > ul > li:nth-child(1) > a').click();

    // When a filter button is clicked
    $('.filter-button').on('click', function () {
      const filter_btn = $(this);
      $('.filter-button').removeClass('active');
      filter_btn.addClass('active');

      var filterValue = filter_btn.data('filter');

      // Hide all cards
      $('.filter-item').hide();

      // Show cards with the selected category or show all if "All" is selected
      if (filterValue === 'all') {
        $('.filter-item').fadeIn();
      } else {
        $('.filter-item.' + filterValue).fadeIn();
      }
    });

    //refresh checkout page after 2 seconds
    $('#wcmca_save_address_button_shipping').on('click', function () {
      setTimeout(function () {
        location.reload();
      }, 5000);
    });

    new DataTable('#example', {
      pageLength: 8, // Show 8 items per page
      lengthChange: false, // Hide the length menu
      language: {
        processing: 'در حال بارگزاری',
        search: ' ',
        info: '',
        infoEmpty: '',
        infoFiltered: '',
        infoPostFix: '',
        loadingRecords: 'در حال بارگزاری',
        zeroRecords: 'محصولی یافت نشد',
        emptyTable: 'پسوندی وجود ندارد',
        searchPlaceholder: 'محصول مورد نظر خود را جستجو کنید...',
        paginate: {
          first: 'اولین',
          previous: 'قبلی',
          next: 'بعدی',
          last: 'قبلی',
        },
        aria: {
          sortAscending: ': activer pour trier la colonne par ordre croissant',
          sortDescending: ': activer pour trier la colonne par ordre décroissant',
        },
      },
      initComplete: function () {
        this.api()
          .columns()
          .every(function () {
            let column = this;
            let title = column.footer().textContent;

            // Create input element
            let input = document.createElement('input');
            input.placeholder = title;
            column.footer().replaceChildren(input);

            // Event listener for user input
            input.addEventListener('keyup', () => {
              if (column.search() !== this.value) {
                column.search(input.value).draw();
              }
            });
          });
      },
    });

    // Replace <br> with space
    if ($('.woocommerce-Addresses .woocommerce-Address address').length > 0) {
      $('.woocommerce-Addresses .woocommerce-Address address').each(function () {
        // Get the HTML content
        var htmlContent = $(this).html();

        // Replace <br> with space
        var updatedContent = htmlContent.replace(/<br>/g, ' ');

        // Set the updated HTML content
        $(this).html(updatedContent);
      });
    }

    if ($('#sidebar-mobile-menu').length > 0) {
      $('#sidebar-mobile-menu').on('click', function () {
        $('#mobile-menu-header').toggleClass('active');
      });

      $('#mobile-menu-header .close').on('click', function () {
        $('#mobile-menu-header').removeClass('active');
      });
    }

    $('#wcmca_billing_state_field > label').text('استان');
    $('#wcmca_billing_city_field .wcmca_form_label').text('شهر');

    $('#vertuka-close-modal').on('click', function () {
      $('#ChooseProductModal').modal('hide');
    });

    if ($('.vertuka-copy-mode').length > 0) {
      $('.vertuka-copy-mode').on('click', function () {
        const element = $(this);
        let copied_text = '';
        if (element.is(':input')) {
          var copyText = element[0];
          copyText.select();
          copyText.setSelectionRange(0, 99999); // For mobile devices

          // Copy the selected text to the clipboard
          document.execCommand('copy');

          // Deselect the text (optional)
          window.getSelection().removeAllRanges();
        } else {
          // Get the text content of the paragraph
          var copyText = element.attr('data-copy-mode').trim();

          // Create a temporary textarea element to copy the text
          var tempTextArea = $('<textarea>');
          tempTextArea.val(copyText);
          $('body').append(tempTextArea);

          // Select the text in the temporary textarea
          tempTextArea.select();
          tempTextArea[0].setSelectionRange(0, 99999); // For mobile devices

          // Copy the selected text to the clipboard
          document.execCommand('copy');

          // Remove the temporary textarea
          tempTextArea.remove();
        }

        element.closest('li').find('.tooltip-copy').fadeIn(500).delay(2500).fadeOut(500);
      });
    }

    $('#med-rp-phone-number').on('keyup change', function () {
      var inputValue = $(this).val();
      var convertedValue = convertArabicIndicToWestern(inputValue);
      $(this).val(convertedValue);
    });

    $('.med-input').on('keyup change', function () {
      var inputValue = $(this).val();
      var convertedValue = convertArabicIndicToWestern(inputValue);
      $(this).val(convertedValue);
    });

    $('#national_code').on('keyup change', function () {
      var inputValue = $(this).val();
      var convertedValue = convertArabicIndicToWestern(inputValue);
      $(this).val(convertedValue);
    });

    $('#wcmca_shipping_postcode').on('keyup change', function () {
      var inputValue = $(this).val();
      var convertedValue = convertArabicIndicToWestern(inputValue);
      $(this).val(convertedValue);
    });

    function convertArabicIndicToWestern(input) {
      var indicNumerals = {
        '٠': '0',
        '١': '1',
        '٢': '2',
        '٣': '3',
        '٤': '4',
        '٥': '5',
        '٦': '6',
        '٧': '7',
        '٨': '8',
        '٩': '9',
        '۰': '0',
        '۱': '1',
        '۲': '2',
        '۳': '3',
        '۴': '4',
        '۵': '5',
        '۶': '6',
        '۷': '7',
        '۸': '8',
        '۹': '9',
      };

      for (var indicNumeral in indicNumerals) {
        var regex = new RegExp(indicNumeral, 'g');
        input = input.replace(regex, indicNumerals[indicNumeral]);
      }

      return input;
    }
})(jQuery);

function MJ_popup_function() {
  // mj add popup
  var modal = document.getElementById('mjModal');
  modal.style.display = 'block';
  // document.getElementsByClassName("mj-popup-close")[0].onclick = function() {
  //     modal.style.display = "none";
  // }
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  };
  // mj end popup
}
function MJ_popup_function_only_one() {
  var modal = document.getElementById('mjModalOnlyOne');
  modal.style.display = 'block';
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  };
  jQuery('.div-close').on('click', function () {
    modal.style.display = 'none';
  });
}
function MJ_popup_function_exit() {
  // mj add popup
  var modal = document.getElementById('mjModal');
  modal.style.display = 'none';
  // mj end popup
}

jQuery(document).ready(function () {
  jQuery('[data-toggle="tooltip"]').tooltip();
});

jQuery(document).ready(function () {
  jQuery('.noptin-label').remove();
  jQuery('#noptin-form-1__field-email').attr('placeholder', 'آدرس ایمیل');
  jQuery('#noptin-form-1__field-email').attr('class', '');
  jQuery('#noptin-form-1__field-email').attr('class', 'newsletters-input mobile-w-100');
  jQuery('#noptin-form-1__field-email').attr('style', 'margin-left:5px;');
  jQuery('#noptin-form-1__submit').text('عضویت');
  jQuery('#noptin-form-1__submit').attr('class', '');
  jQuery('#noptin-form-1__submit').attr('class', 'button bg-success text-white box-shadow-none border-0');
  jQuery('.noptin-form-fields').attr('class', 'noptin-form-fields d-flex');
});
jQuery(document).ready(function ($) {
  $('#noptin-form-1__submit').val('ارسال');
});
