document.addEventListener("DOMContentLoaded", function () {
  // Get the preloader element
  const preloader = document.getElementById("preloader");
  // Find the slider element
  const sliderBox = document.querySelector(".owl-item");

  // Function to hide the preloader
  const hidePreloader = () => {
    preloader.classList.add("hidden");
  };

  if (sliderBox) {
    // Try to find all img elements within sliderBox
    hidePreloader();
  } else {
    // Fallback: if sliderBox is not found, hide the preloader when the window has fully loaded
    window.addEventListener("load", function () {
      setTimeout(function () {
        hidePreloader();
      }, 500); // Delay before hiding the preloader
    });
  }
});
