// jQuery(document).ready(function ($) {


//     //Anchor behavior
//     //on load
//     var identifier = window.location.hash;
//     if ($(identifier).length)         
//     {
//           changeTabs(identifier);
//     }
  
//     //fires when anchor changed
//     window.addEventListener('hashchange', function () {
//       var identifier = window.location.hash;
//       if ($(identifier).length)         
//       {
//             changeTabs(identifier);
//       }else {
//         changeTabs('#overview');
  
//       }
//     })
  
//     //Navigation Events - change anchor
//     $('.product-nav__tab-list__item__link, .goto-cabins, .goto-itineraries, .goto-prices, .goto-dates').click(function (event) {
//       event.preventDefault();
//       var tab_id = $(this).attr('href');
//       window.location.hash = tab_id;
  
//     })
  
  
//     //Change Tabs Function
//     function changeTabs(identifier) {
//       tab_id = identifier.substring(1); //remove hash
  
//       $('.product-nav__tab-list__item').removeClass('current');
//       $('.product-content__page.tab-content').removeClass('current');
  
//       $(".tab-" + tab_id).addClass('current'); //apply to both original / clone (sticky) -- class is same name as data-tab id
//       $("#" + tab_id).addClass('current'); //apply to tab content
  
//       //tab jump marks and offsets
//       var offset = 0;
  
//       //responsive @ 1000
//       if ($(window).width() > 1000) {
//         offset = 120;
//         if (tab_id == "itineraries") {
//           offset = 180
//         }
//       }
//       else {
//         offset = 90;
//         if (tab_id == "itineraries") {
//           offset = 140
//         }
//       }
  
//       //if the sticky nav is visible
//       var elementExists = document.getElementById("page-nav");
//       if (elementExists != null) {
//         console.log('yes')
//         $([document.documentElement, document.body]).animate({
//           scrollTop: $("#sentinal-" + tab_id).offset().top - offset
//         }, 300);
//       } else {
//         console.log('no')
  
//       }
//     }
  
  

//     //Burger
//     //Burger Menu -- click
//     $(".page-nav__button").on("click", function () {
  
//       $('.page-nav__button').toggleClass('page-nav__button--active');
//       $('.page-nav__collapse').toggleClass('page-nav__collapse--active');
  
//     });
  
//     //Burger Menu -- resize window -- remove collapse menu over 1000
//     $(window).resize(function () {
//       if ($(window).width() > 600) {
//         $('.page-nav__collapse').removeClass('page-nav__collapse--active');
//         $('.page-nav__button').removeClass('page-nav__button--active');
  
//       } 
//     });
  
  
//     //Page Nav -- Sticky 
//     var navbar = document.querySelector('#template-nav');
//     var subnavTitle = document.querySelector('#template-nav-title');
  
//     var offsetY = navbar.offsetTop;
  
//     window.onscroll = function () { myFunction() };
//     function myFunction() {
  
//       var isElementInView = Utils.isElementInView($('#template-nav'), false);
  
//       if (isElementInView) {
//         $('#page-nav').remove();
//       } else { //if template nav is out of view
  
  
//         //and if burger menu isnt active
//         if ($(".burger-menu").hasClass('burger-menu--active') != true) {
  
//           var elementExists = document.getElementById("page-nav"); //and not already there
//           if (elementExists == null) {
//             var newNav = $(navbar).clone(true); //clone the nav and append it to header (pass true to clone events also)
//             newNav.attr('id', 'page-nav');
  
//             $(newNav).addClass('product-nav__sticky-wrapper--active');
//             $('#header').append(newNav);
//           }
  
//           var elementExists = document.getElementById("page-nav-title"); //clone / append title
//           if (elementExists == null) {
//             var newTitle = $(subnavTitle).clone(true);
//             newTitle.attr('id', 'page-nav-title')
//             $(newTitle).addClass('product-nav__caption__title--sticky'); //create common style
//             $('#page-nav').append(newTitle);
//           }
//         }
//       }
//     }

  
  
//   });
  