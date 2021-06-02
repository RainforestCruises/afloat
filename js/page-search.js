
jQuery(document).ready(function ($) {



  //Mobile Filter Bar
  const searchMobileCTA = document.getElementById('search-filter-mobile-cta');

  const searchFilterBar = document.getElementById('search-filter-bar');
  const searchSortControl = document.getElementById('sort-control');
  const searchResultsTop = document.getElementById('search-results-top');
  const searchContent = document.getElementById("search-page-content");
  const searchIntro = document.getElementById('search-page-intro').offsetHeight;
  const searchFilterButton = document.getElementById('search-filter-bar-button');
  const searchSidebar = document.getElementById('search-sidebar');
  const searchMobileClose = document.getElementById('search-sidebar-mobile-close-button');
  const headerDiv = document.getElementById('header');
  const body = document.getElementById('header');

  searchFilterButton.addEventListener('click', () => {

    searchSidebar.classList.add('show');
    document.body.classList.add('lock-scroll');
    searchMobileCTA.style.display = 'block';
    headerDiv.appendChild(searchSidebar);

  });

  searchMobileClose.addEventListener('click', () => {
    searchSidebar.classList.remove('show');
    document.body.classList.remove('lock-scroll');
    searchMobileCTA.style.display = 'none';
    searchContent.insertBefore(searchSidebar, searchContent.firstChild);
  });

  //move sort filter -- initial
  if ($(window).width() < 1000) {
    searchFilterBar.appendChild(searchSortControl)
  }
  else {
    searchResultsTop.appendChild(searchSortControl)
  }

  //move sort filter
  $(window).resize(function () {

    if ($(window).width() < 1000) {
      document.body.classList.remove('lock-scroll');

      //sort control
      if (searchFilterBar.contains(searchSortControl) == false) {
        searchFilterBar.appendChild(searchSortControl)
      }

      //sidebar
      if (headerDiv.contains(searchSidebar) == false) {
        headerDiv.appendChild(searchSidebar)
        
      }

    }

    else {
      

      //sort control
      if (searchResultsTop.contains(searchSortControl) == false) {
        searchResultsTop.appendChild(searchSortControl);
      }

      //sidebar
      if (searchContent.contains(searchSidebar) == false) {
        searchContent.insertBefore(searchSidebar, searchContent.firstChild);
      }
    }
  });

  //sticky on scroll 
  $(window).scroll(function () {
    if ($(this).scrollTop() > searchIntro) {
      searchFilterBar.classList.add("sticky");
    } else {
      searchFilterBar.classList.remove("sticky");
    }

    //for the content add margin top to prevent jump
    if ($(this).scrollTop() > searchIntro) {
      searchContent.classList.add("sticky");
    } else {
      searchContent.classList.remove("sticky");
    }
  });


  //FORM ----------------
  //form variables
  const formDates = document.querySelector('#formDates');
  const formTravelStyles = document.querySelector('#formTravelStyles');
  const formDestinations = document.querySelector('#formDestinations');
  const formExperiences = document.querySelector('#formExperiences');
  const formMinLength = document.querySelector('#formMinLength');
  const formMaxLength = document.querySelector('#formMaxLength');
  const formSort = document.querySelector('#formSort');
  const formPageNumber = document.querySelector('#formPageNumber');



  //Expand Lists --------------------------------------------
  // Departure List -- Show More Dates
  $("#departure-show-more").click(function () {
    toggleDeparturesExpanded();
  });

  const toggleDeparturesExpanded = () => {
    $("#departure-filter-list").toggleClass("expanded");
    var isExpanded = $("#departure-filter-list").hasClass("expanded");
    if (isExpanded == true) {
      $('#departure-show-more').html("Show Less");
    } else {
      $('#departure-show-more').html("Show More");
    }
  }

  //expand if hidden checkbox is selected upon page load
  const departureDatesExpandedArray = [...document.querySelectorAll('.checkbox-expand-group')];
  let hasExpanded = false;
  departureDatesExpandedArray.forEach(item => {
    if (item.checked == true) {
      hasExpanded = true;
    }
  })
  if (hasExpanded == true) {
    toggleDeparturesExpanded();
  }


  //Intro Snippet
  $(".search-intro__title").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    $this.parent().find('.search-intro__text').slideToggle(350);
    $this.toggleClass('search-intro__title--collapsed');
  });

  //Search Filters expand/hide
  $(".filter__heading").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    $this.parent().find('.filter__content').slideToggle(350);
    $this.parent().find('.filter__heading').toggleClass('closed');
  });



  //Search Filter Selections ------------------------------------
  //Departure Date selections
  let departuresString = formDates.value;
  const departureDatesArray = [...document.querySelectorAll('.departure-checkbox')];
  departureDatesArray.forEach(item => {
    item.addEventListener('click', () => {
      departuresString = "";
      let count = 0;
      departureDatesArray.forEach(checkbox => {
        const itemValue = checkbox.value;

        if (checkbox.checked) {

          if (count > 0) {
            departuresString += ";";
          }
          departuresString += itemValue;
          count++;
        }
      })

      formDates.value = departuresString;
      reloadResults();

    });
  })

  //Travel Style selections
  let travelStylesString = formTravelStyles.value;
  const travelStylesArray = [...document.querySelectorAll('.travel-style-checkbox')];
  travelStylesArray.forEach(item => {
    item.addEventListener('click', () => {

      //if charterCruises = selected --> make unselected
      if (item.value != 'charter_cruises') {
        const charterCheckbox = document.getElementById('charterCheckbox');
        charterCheckbox.checked = false;
      } else {
        //if this is charterCruises (and not selected) --> unselect all the other checkboxes
        if (item.checked == true) {
          travelStylesArray.forEach(checkboxItem => {
            checkboxItem.checked = false;
          });
          charterCheckbox.checked = true;
        }
      }

      travelStylesString = "";
      let count = 0;
      travelStylesArray.forEach(checkbox => {
        const itemValue = checkbox.value;
        if (checkbox.checked) {
          if (count > 0) {
            travelStylesString += ";";
          }
          travelStylesString += itemValue;
          count++;
        }
      })

      formTravelStyles.value = travelStylesString;

      reloadResults();
    });
  })

  //Destination selections
  let destinationsString = formDestinations.value;
  const destinationsArray = [...document.querySelectorAll('.destination-checkbox')];
  destinationsArray.forEach(item => {
    item.addEventListener('click', () => {
      destinationsString = "";
      let count = 0;
      destinationsArray.forEach(checkbox => {
        const itemValue = parseInt(checkbox.value);

        if (checkbox.checked) {
          if (count > 0) {
            destinationsString += ";";
          }
          destinationsString += itemValue;
          count++;
        }
      })

      formDestinations.value = destinationsString;
      reloadResults();
    });
  })

  //Experiences selections
  let experiencesString = formExperiences.value;
  const experiencesArray = [...document.querySelectorAll('.experience-checkbox')];
  experiencesArray.forEach(item => {
    item.addEventListener('click', () => {
      experiencesString = "";
      let count = 0;
      experiencesArray.forEach(checkbox => {
        const itemValue = parseInt(checkbox.value);

        if (checkbox.checked) {

          if (count > 0) {
            experiencesString += ";";
          }
          experiencesString += itemValue;
          count++;
        }

      })
      formExperiences.value = experiencesString;
      reloadResults();
    });
  })

  //Length Slider
  $("#range-slider").ionRangeSlider({
    skin: "round",
    type: "double",
    min: 1, //default
    max: 21, //default
    from: formMinLength.value,
    to: formMaxLength.value,
    postfix: " Day",
    max_postfix: "+",
    onFinish: function () {

      formMinLength.value = $("#range-slider").data("from");
      formMaxLength.value = $("#range-slider").data("to");


      reloadResults();
    },
  });

  //Sorting
  $('#result-sort').select2({
    width: 'auto',
    dropdownAutoWidth: true,
    minimumResultsForSearch: -1,
  });

  $('#result-sort').on('change', function () {
    formSort.value = $(this).val();
    formPageNumber.value = 1;
    reloadResults();
  });

  $('#result-sort').select2('destroy');
  $('#result-sort').val(formSort.value).select2({
    width: 'auto',
    dropdownAutoWidth: true,
    minimumResultsForSearch: -1,

  });

  //RELOAD RESULTS
  function reloadResults(preservePage) {

    //set url params
    const params = new URLSearchParams(location.search);

    if (departuresString != null) {
      params.set('departures', departuresString);
    }

    if (travelStylesString != null) {
      params.set('travel_style', travelStylesString);
    }

    if (destinationsString != null) {
      params.set('destinations', destinationsString);
    }

    if (experiencesString != null) {
      params.set('experiences', experiencesString);
    }

    if (formMinLength.value != null) {
      params.set('length_min', formMinLength.value);
    }

    if (formMinLength.value != null) {
      params.set('length_max', formMaxLength.value);
    }

    if (formSort.value != null) {
      params.set('sorting', formSort.value);
    }

    if (preservePage == true) {
      $('body, html, .search-results').animate({ scrollTop: 0 }, "fast"); //paging scroll up
      if (formPageNumber.value != null) {
        params.set('pageNumber', formPageNumber.value);
      }
    } else {
      formPageNumber.value = 1;
      params.set('pageNumber', formPageNumber.value);
    }



    window.history.replaceState({}, '', `${location.pathname}?${params}`);


    //ajax call / submit form
    var searchForm = $('#search-form');
    $.ajax({
      url: searchForm.attr('action'),
      data: searchForm.serialize(),
      type: searchForm.attr('method'),
      beforeSend: function () {
        $('#response').addClass('loading'); //indicate loading
        $('.search-sidebar').addClass('loading'); //indicate loading
        $("#response").append('<div class="lds-dual-ring"></div>');
        $('#response-count').html('Searching...');
      },
      success: function (data) {
        $('#response').removeClass('loading');
        $('.search-sidebar').removeClass('loading'); //indicate loading
        $(".lds-dual-ring").remove();



        $('#response').html(data); //return the markup -- content-primary-search-results.php


        var resultCount = $('#totalResultsDisplay').attr('value');
        var pageNumberDisplay = $('#pageNumberDisplay').attr('value');

        var resultCountDisplay = ""
        if (resultCount == 1) {
          resultCountDisplay = "Found " + resultCount + " result"
        } else {
          resultCountDisplay = "Found " + resultCount + " results"
        }
        $('#response-count').html(resultCountDisplay);



        let pageButtonArray = [...document.querySelectorAll('.search-results__grid__pagination__pages-group__button')];


        //post-ajax loaded button js
        pageButtonArray.forEach(item => {
          item.addEventListener('click', (e) => {
            var pageNumber = item.value;

            if (!item.classList.contains('current') && !item.classList.contains('disabled')) {

              // next button
              if (item.classList.contains('search-results__grid__pagination__pages-group__button--next-button')) {
                var pageGoTo = (+pageNumberDisplay + 1);
                $("#formPageNumber").val(pageGoTo);

                // back button
              } else if (item.classList.contains('search-results__grid__pagination__pages-group__button--back-button')) {
                var pageGoTo = (+pageNumberDisplay - 1);
                $("#formPageNumber").val(pageGoTo);

                //all button
              } else if (item.classList.contains('search-results__grid__pagination__pages-group__button--all-button')) {
                $("#formPageNumber").val('all');

                //page button
              } else {
                var pageNumber = item.value;
                $("#formPageNumber").val(pageNumber);
              }
              reloadResults(true);
            }

          });
        })

      }
    });
  }


  //initial loaded button js
  let pageButtonArray = [...document.querySelectorAll('.search-results__grid__pagination__pages-group__button')];
  pageButtonArray.forEach(item => {
    item.addEventListener('click', (e) => {
      var pageNumberDisplay = formPageNumber.value;
      var pageNumber = item.value;

      if (!item.classList.contains('current') && !item.classList.contains('disabled')) {

        // next button
        if (item.classList.contains('search-results__grid__pagination__pages-group__button--next-button')) {
          var pageGoTo = (+pageNumberDisplay + 1);
          $("#formPageNumber").val(pageGoTo);

          // back button
        } else if (item.classList.contains('search-results__grid__pagination__pages-group__button--back-button')) {
          var pageGoTo = (+pageNumberDisplay - 1);
          $("#formPageNumber").val(pageGoTo);

          //all button
        } else if (item.classList.contains('search-results__grid__pagination__pages-group__button--all-button')) {
          $("#formPageNumber").val('all');

          //page button
        } else {
          var pageNumber = item.value;
          $("#formPageNumber").val(pageNumber);
        }
        reloadResults(true);
      }

    });
  })








});


