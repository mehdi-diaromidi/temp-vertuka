jQuery(document).ready(function ($) {
  // Slider
  $(".slider-box .owl-carousel").owlCarousel({
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
});
