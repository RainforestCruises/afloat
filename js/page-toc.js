jQuery(document).ready(function ($) {
  // On Click - Nav Links, href change position
  $(".toc-link").click(function (event) {
    var id = $(this).attr("href");
    console.log(id);
    changePosition(id);
    event.preventDefault();
  });

  // Animate Change Position
  function changePosition(id) {
    id = id.replace("#", "");
    var target = $("[name='" + id + "']").offset().top;

    if ($(window).width() > 1200) {
      target = target - 160;
    } else {
      // small screen correction
      target = target - 120;
    }

    $("html, body").animate({ scrollTop: target }, 500);
    window.location.hash = id;
  }
  // Guide Menu
  // button click
  $(".guide-menu__button").on("click", function () {
    $(".guide-menu__menu").toggleClass("active");
  });

  // click away, close menu
  const navGuideMenu = document.querySelector(".guide-menu__menu");
  const navGuideButton = document.querySelector(".guide-menu__button");

  document.addEventListener("click", (evt) => {
    const isButtonClick = navGuideButton.contains(evt.target);
    const isOpen = navGuideMenu.classList.contains("active");

    if (!isButtonClick && isOpen) {
      navGuideMenu.classList.remove("active");
    }
  });
  //On Scroll Listener
  window.onscroll = function () {
    scrollCheck();
  };
  function scrollCheck() {
    var threshHold = 620;
    if ($(window).width() > 1000) {
      threshHold = 1200;
    }

    if (window.scrollY < threshHold) {
      $(".guide-menu-area").removeClass("active");
    } else if (window.scrollY > $(document).height() - 2000) {
      $(".guide-menu-area").removeClass("active");
    } else {
      $(".guide-menu-area").addClass("active");
    }
  }
});
