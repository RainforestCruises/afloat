jQuery(document).ready(function ($) {
    // Down Arrow
    $('#mobile-search-button').click(function (event) {
        
        const body = document.querySelector('body');
        body.classList.add('lock-scroll');
        const overlay = document.querySelector('.home-full-search');
        overlay.classList.add('active');

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
    const inputField = document.querySelector('.home-destination-select');
    const dropdown = document.querySelector('.home-destination-value-list');
    const label = document.querySelector('#chosen-value-label');
    const dropdownArray = [...document.querySelectorAll('.home-destination-value-list li')];
    let selectedDestination = 0;

    for (let i = 0; i < dropdownArray.length; i++) {
        dropdownArray[i].classList.add('closed');
    }

    let valueArray = [];
    dropdownArray.forEach(item => {
        valueArray.push(item.textContent);
    });

    inputField.addEventListener('input', () => {
        dropdown.classList.add('open');
        let inputValue = inputField.value.toLowerCase();
        if (inputValue.length > 0) {
            for (let j = 0; j < valueArray.length; j++) {
                if (!(inputValue.substring(0, inputValue.length) === valueArray[j].substring(0, inputValue.length).toLowerCase())) {
                    dropdownArray[j].classList.add('closed');
                } else {
                    dropdownArray[j].classList.remove('closed');
                }
            }
        } else {
            for (let i = 0; i < dropdownArray.length; i++) {
                dropdownArray[i].classList.remove('closed');
            }
        }


    });


    //add click event handler to each LI
    dropdownArray.forEach(item => {
        item.addEventListener('click', () => {
            inputField.value = item.textContent;
            selectedDestination = item.getAttribute("postId");
            dropdownArray.forEach(dropdown => {
                dropdown.classList.add('closed');
            });
        });
    })

    inputField.addEventListener('focus', () => {
        inputField.placeholder = 'Where would you like to go?'; //can change here to new placeholder
        dropdown.classList.add('open');
        label.classList.add('open');
        dropdownArray.forEach(dropdown => {
            dropdown.classList.remove('closed');
        });
    });

    //leave focus
    inputField.addEventListener('blur', () => {
        inputField.placeholder = 'Where would you like to go?';
        label.classList.remove('open');

        let ddSuggest = [];
        dropdownArray.forEach(dropdown => {
            if (!dropdown.classList.contains('closed')) {
                ddSuggest.push(dropdown);
            }
        });

        if (ddSuggest.length == 0) {
            inputField.classList.add('error')
        } else {
            inputField.classList.remove('error')
            //check if matches one
            let match = false;
            ddSuggest.forEach(element => {
                if (element.textContent == inputField.value) {
                    match = true;
                }
            });
            if (!match) {
                inputField.value = ddSuggest[0].textContent;
                selectedDestination = ddSuggest[0].getAttribute("postId");
            }
        }
    });

    document.addEventListener('click', evt => {
        const isDropdown = dropdown.contains(evt.target);
        const isInput = inputField.contains(evt.target);
        if (!isDropdown && !isInput) {
            dropdown.classList.remove('open');
            label.classList.remove('open');
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
    //END DESTINATION SELECT -----------------------------------------------------------------------------------
    // $(document).on('keydown', function (e) {
    //     var keyCode = e.keyCode || e.which;     
    //     if (keyCode == 9) {
    //         e.preventDefault();

    //     }
    // });


    //DATE SELECT COMPONENT ------------------------------------------------------------------------------------
    const dateInputField = document.querySelector('#date-select');
    const dateDropdown = document.querySelector('#date-values');
    const dateLabel = document.querySelector('#date-label');
    const dateDropdownArray = [...document.querySelectorAll('.home-date-values__months li')];
    const dateYearArray = [...document.querySelectorAll('.home-date-values__years__year')];

    let selectedYear = moment().format('YYYY');
    let selectedMonth = moment().format('MM');
    let currentYear = moment().format('YYYY');
    let currentMonth = moment().format('MM');


    //Dates LI initialize
    //if current year, disable past months, if prox year, remove all disabled -- on first load
    dateDropdownArray.forEach(item => {
        if (selectedYear == currentYear) {
            if (item.getAttribute('month') < currentMonth) {
                item.classList.add('disabled');
            }
        } else {
            item.classList.remove('disabled');
        }

        if (item.getAttribute('month') == currentMonth) {
            item.classList.add('selected');
        }
    })


    //Input Field Click
    dateInputField.addEventListener('click', () => {
        dateInputField.innerHTML = moment(selectedMonth, 'MM').format('MMMM') + ", " + selectedYear;
        dateDropdown.classList.add('open');
        dateLabel.classList.add('open');
        dateInputField.classList.add('open');
    });

    //Year Click - event handler to each LI
    dateYearArray.forEach(item => {
        item.addEventListener('click', () => {

            selectedYear = item.getAttribute("year");
            //if current year, disable past months, if prox year, remove all disabled -- fires every time year is clicked
            dateDropdownArray.forEach(item => {
                if (selectedYear == currentYear) {

                    if (item.getAttribute('month') < currentMonth) {
                        item.classList.add('disabled');
                        //if on prox year and selected prev month and went back to prev year, set month selected to current month
                        if (item.classList.contains('selected')) {
                            item.classList.remove('selected');
                            //find item with current month and apply selected
                            dateDropdownArray.forEach(monthItem => {
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

            dateInputField.innerHTML = moment(selectedMonth, 'MM').format('MMMM') + ", " + selectedYear;

            dateYearArray.forEach(year => {
                year.classList.remove('selected');
            });

            item.classList.add('selected')
        });
    })

    //Month Click - event handler to each LI
    dateDropdownArray.forEach(item => {
        item.addEventListener('click', () => {
            if (!item.classList.contains('disabled')) {
                selectedMonth = item.getAttribute("month");
                dateInputField.innerHTML = moment(selectedMonth, 'MM').format('MMMM') + ", " + selectedYear;

                dateDropdownArray.forEach(month => {
                    month.classList.remove('selected');
                });
                item.classList.add('selected');
                closeDropdown();
            }

        });
    })

    document.addEventListener('click', evt => {
        const isInput = dateInputField.contains(evt.target);
        const isDropdown = dateDropdown.contains(evt.target);
        if (!isInput && !isDropdown) {
            closeDropdown();
        }
    });

    const closeDropdown = () => {
        dateDropdown.classList.remove('open');
        dateInputField.classList.remove('open');
        dateLabel.classList.remove('open');
    }


    const searchButton = document.querySelector('#search-button');
    searchButton.addEventListener('click', (e) => {
        $("#travel-destination").val(selectedDestination);
        $("#travel-month").val(selectedMonth);
        $("#travel-year").val(selectedYear);

        if (selectedDestination == 0) {
            e.preventDefault();
            inputField.classList.add('error')
        } else {
            searchButton.classList.add('loading');
        }
    });



});



