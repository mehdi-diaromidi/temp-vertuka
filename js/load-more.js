jQuery(function ($) {
  var loading = false;

  // زمانی که کاربر روی دکمه بارگذاری بیشتر کلیک می‌کند
  $("#load-more").click(function () {
    if (loading) return;
    loading = true;

    var button = $(this);
    var current_page = loadmore_params.current_page;
    var max_page = loadmore_params.max_page;

    // اگر هنوز صفحات بعدی وجود داشته باشد
    if (current_page < max_page) {
      current_page++;

      // ارسال درخواست AJAX به وردپرس
      $.ajax({
        url: loadmore_params.ajax_url,
        type: "POST",
        data: {
          action: "load_more_products",
          page: current_page,
        },
        success: function (response) {
          // اگر پاسخ موفقیت‌آمیز بود، محصولات جدید را به صفحه اضافه کن
          if (response) {
            $("#product-list").append(response);
            loadmore_params.current_page = current_page;
          }
          loading = false;
        },
      });
    } else {
      // اگر همه صفحات بارگذاری شده باشد، دکمه را مخفی کن
      button.hide();
    }
  });
});
