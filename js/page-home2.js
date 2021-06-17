jQuery(document).ready(function ($) {
    // Down Arrow
    $('#mobile-search-button').click(function (event) {

        const body = document.querySelector('body');
        body.classList.add('lock-scroll');
        const overlay = document.querySelector('.home-full-search');
        overlay.classList.add('active');

    })

    $('#mobile-search-close').click(function (event) {

        const body = document.querySelector('body');
        body.classList.remove('lock-scroll');
        const overlay = document.querySelector('.home-full-search');
        overlay.classList.remove('active');

    })

    // Down Arrow
    $('#down-arrow-button').click(function (event) {
        var id = $(this).attr('href');
        changePosition(id)
        event.preventDefault();
    })

    // Animate Change Position
    function changePosition(id) {
        var target = $(id).offset().top;
        target = target - 50;
        $('html, body').animate({ scrollTop: target }, 500);
        window.location.hash = id;
    }


    //SLIDERS
    $('#intro-testimonials').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 4000
    });

    $('#intro-testimonials').on("click", function () {
        $('#intro-testimonials').slick("slickNext");
    });


    $('#destinations-slider').slick({
        rows: 2,
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        prevArrow: '<button class="btn-circle btn-dark btn-circle--left home-destinations__destinations-area__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-dark btn-circle--right home-destinations__destinations-area__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',

        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    rows: 1,
                    arrows: false,
                    centerMode: true
                }
            },

        ]
    });


    //SLIDER - Featured Cruises
    $('#featured-cruises').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: true,
        prevArrow: '<button class="btn-icon-move btn-icon-move--left home-featured__content-area__btn--left"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg></button>',
        nextArrow: '<button class="btn-icon-move btn-icon-move--right home-featured__content-area__btn--right"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg></button>',
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                    fade: false,
                    arrows: false
                }
            }
        ]
    });

    //SLIDER - Featured Bucket List
    $('#featured-bucket').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: true,
        prevArrow: '<button class="btn-icon-move btn-icon-move--left home-featured__content-area__btn--left"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg></button>',
        nextArrow: '<button class="btn-icon-move btn-icon-move--right home-featured__content-area__btn--right"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg></button>',
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    centerMode: true,
                    fade: false,
                    arrows: false
                }
            },


        ]
    });

    //SLIDER - Featured Bucket List
    $('#main-testimonials').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        dots: true,
        arrows: false,

    });


    //DESTINATION SELECT COMPONENT --------------------------------------------------------------------------------------------
    const destinationInputContainer = document.querySelector('#destination-input-container');
    const destinationInput = document.querySelector('#destination-input');
    const destinationList = document.querySelector('#destination-list');
    const searchContainer = document.querySelector('#search-container');
    const destinationListItems = [...document.querySelectorAll('#destination-list li')];

    let suggestionsArray = [];
    let selectedDestination = 0;
    let selectedDestinationName = "";

    for (let i = 0; i < destinationListItems.length; i++) {
        destinationListItems[i].classList.add('closed');
    }

    let destinationStringArray = []; //array of destination strings
    destinationListItems.forEach(item => {
        destinationStringArray.push(item.textContent);
    });



    //occurs on typing text into destination field
    destinationInput.addEventListener('input', () => {
        //console.log('DI Input');
        destinationList.classList.add('open');
        let inputValue = destinationInput.value.toLowerCase();

        let inputSuggestions = [];

        if (inputValue.length > 0) {
            for (let j = 0; j < destinationStringArray.length; j++) {
                if (!(inputValue.substring(0, inputValue.length) === destinationStringArray[j].substring(0, inputValue.length).toLowerCase())) {
                    destinationListItems[j].classList.add('closed');
                } else {
                    destinationListItems[j].classList.remove('closed');
                    inputSuggestions.push(destinationListItems[j].textContent);
                }
            }
        } else {
            for (let i = 0; i < destinationListItems.length; i++) {
                destinationListItems[i].classList.remove('closed');
            }
        }

        suggestionsArray = inputSuggestions;

    });


    //add click event handler to each LI
    destinationListItems.forEach(item => {

        item.addEventListener('mousedown', (e) => {

            e.preventDefault(); //prevent blur

            //console.log('destination item click event');
            destinationInput.value = item.textContent;
            selectedDestination = item.getAttribute("postId");

            destinationListItems.forEach(dropdown => {
                dropdown.classList.add('closed');
            });

            showDateSelect();
        });
    })

    destinationInput.addEventListener('focus', () => {
        destinationInput.placeholder = 'Where would you like to go?'; //can change here to new placeholder
        destinationList.classList.add('open');
        searchContainer.classList.add('active');
        datesList.classList.remove('open');

        destinationListItems.forEach(dropdown => {
            dropdown.classList.remove('closed');
        });
        suggestionsArray = [];
    });

    //leave focus
    destinationInput.addEventListener('blur', (event) => {


        destinationList.classList.remove('open');
        let destinationListOpen = destinationList.classList.contains('open');
        //console.log('blur event');


        if (!destinationListOpen) {
            if (suggestionsArray.length == 0) {
                //dont assign any if nothing selected
            } else {
                destinationInput.value = suggestionsArray[0];
                showDateSelect();
            }
        }



    });


    ////CLICK AWAY
    document.addEventListener('click', evt => {
        //console.log('click away')
        const isDestinationInput = destinationInput.contains(evt.target);
        const isDatesInput = datesInput.contains(evt.target);
        const isDatesList = datesList.contains(evt.target);

        const isSearchContainer = searchContainer.contains(evt.target);


        if (!isDestinationInput) {
            destinationList.classList.remove('open');
        }

        if (!isDatesInput && !isDatesList) { //needs both because not all area is clickable space
            datesList.classList.remove('open');
        }

        if (!isDestinationInput && !isDatesInput && !isSearchContainer) {
            searchContainer.classList.remove('active'); //here
        }

    });

    //Tab press
    $('.home-destination-select').on('keydown', function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode == 9) {
            e.preventDefault();
            document.activeElement.blur();
            document.querySelector('#date-select').click();
        }
    });

    function showDateSelect() {
        searchContainer.classList.add('expand');
        datesInputContainer.classList.add('show');
    }

    //END DESTINATION SELECT -----------------------------------------------------------------------------------





    // //DATE SELECT COMPONENT ------------------------------------------------------------------------------------
    const datesInputContainer = document.querySelector('.home-search__dates');
    const datesInput = document.querySelector('#dates-input');
    const datesList = document.querySelector('#dates-list');
    const datesListItems = [...document.querySelectorAll('#dates-list li')];

    const dateYearArray = [...document.querySelectorAll('.home-search__dates__list__years__year')];




    let selectedYear = moment().format('YYYY');  //fix this
    let selectedMonth = moment().format('MM');
    let currentYear = moment().format('YYYY');
    let currentMonth = moment().format('MM');


    //Dates LI initialize
    //if current year, disable past months, if prox year, remove all disabled -- on first load
    datesListItems.forEach(item => {
        if (selectedYear == currentYear) {
            if (item.getAttribute('month') < currentMonth) {
                item.classList.add('disabled');
            }
        } else {
            item.classList.remove('disabled');
        }
    })


    //Input Field Click
    datesInput.addEventListener('click', () => {
        datesList.classList.add('open');
        datesInput.classList.add('open');
        searchContainer.classList.add('active');

        console.log('date input field click');

    });

    //Year Click - event handler to each LI
    dateYearArray.forEach(item => {
        item.addEventListener('click', () => {

            selectedYear = item.getAttribute("year");

            //if current year, disable past months, if prox year, remove all disabled -- fires every time year is clicked
            datesListItems.forEach(item => {
                if (selectedYear == currentYear) {

                    if (item.getAttribute('month') < currentMonth) {
                        item.classList.add('disabled');
                        //if on prox year and selected prev month and went back to prev year, set month selected to current month
                        if (item.classList.contains('selected')) {
                            item.classList.remove('selected');
                            //find item with current month and apply selected
                            datesListItems.forEach(monthItem => {
                                if (monthItem.getAttribute('month') == currentMonth) {
                                    monthItem.classList.add('selected')
                                    selectedMonth = monthItem.getAttribute("month");
                                }
                            })
                        }
                    }
                } else {
                    item.classList.remove('disabled');
                }
            })

            //needs to track both year sets independently !!
            //datesInput.innerHTML = moment(selectedMonth, 'MM').format('MMMM') + ", " + selectedYear; -- fix

            dateYearArray.forEach(year => {
                year.classList.remove('selected');
            });

            item.classList.add('selected')
        });
    })

    //Month Click - event handler to each LI
    datesListItems.forEach(item => {
        item.addEventListener('click', (e) => {
            if (!item.classList.contains('disabled')) {
                selectedMonth = item.getAttribute("month");

                datesInput.innerHTML = moment(selectedMonth, 'MM').format('MMMM') + ", " + selectedYear; //can get from attribute string

                datesListItems.forEach(month => {
                    month.classList.remove('selected');
                });
                item.classList.add('selected');


                datesList.classList.remove('open');
                searchContainer.classList.remove('active');
            }

        });
    })





    //Mobile Rearrangement ---------------------
    const homeFullSearch = document.querySelector('.home-full-search');


    //move sort filter -- initial
    if ($(window).width() < 1000) {
        homeFullSearch.appendChild(destinationInputContainer);
        //homeFullSearch.appendChild(destinationInputContainer);

    }
    // else {
    //     searchResultsTop.appendChild(searchSortControl)
    // }

});



