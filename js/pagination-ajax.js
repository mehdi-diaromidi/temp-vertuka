jQuery(function ($) {
  const button = $("#load-more-products");
  const spinner = $(".loading-spinner");
  let currentPage = parseInt(ajax_params.current_page);
  const maxPages = parseInt(ajax_params.max_page);

  if (currentPage >= maxPages) {
    button.hide();
  }

  button.on("click", function () {
    currentPage++;
    spinner.show();
    button.prop("disabled", true);

    $.ajax({
      url: ajax_params.ajax_url,
      type: "POST",
      data: {
        action: "load_more_products",
        page: currentPage,
        category: ajax_params.category,
      },
      success: function (response) {
        if (response.success && response.data) {
          $(".products").append(response.data);
          if (currentPage >= maxPages) {
            button.hide();
          }
        } else {
          console.log("Error loading products");
        }
        spinner.hide();
        button.prop("disabled", false);
      },
      error: function (error) {
        console.log("Ajax error:", error);
        spinner.hide();
        button.prop("disabled", false);
      },
    });
  });
});
