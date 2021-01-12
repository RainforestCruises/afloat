jQuery(document).ready(function ($) {

    // quick search regex
    var qsRegex;
    var buttonFilter;

    // init Isotope
    var resultsGrid = $('#results').isotope({
        itemSelector: '.guide-item',
        layoutMode: 'fitRows',
        filter: function () {
            var $this = $(this);
            var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
            var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
            return searchResult && buttonResult;
        }
    });


        // bind filter button click
    $('.filters-button-group').on('click', 'button', function () {
        buttonFilter = $(this).attr('data-filter');
        $('#quicksearch').val('');
        qsRegex = '';
        resultsGrid.isotope();

        $('.filter-button').removeClass('selected');
        $(this).addClass('selected');
    
    });



    // use value of search field to filter
    var $quicksearch = $('#quicksearch').keyup(debounce(function () {
        qsRegex = new RegExp($quicksearch.val(), 'gi');
        buttonFilter = '';

        $('.filter-button').removeClass('selected');
        $('.filter-button-all').addClass('selected');

        resultsGrid.isotope();
    }));

    // debounce so filtering doesn't happen every millisecond
    function debounce(fn, threshold) {
        var timeout;
        return function debounced() {
            if (timeout) {
                clearTimeout(timeout);
            }
            function delayed() {
                fn();
                timeout = null;
            }
            setTimeout(delayed, threshold || 100);
        };
    }







    // // external js: isotope.pkgd.js

    // // init Isotope
    // var resultsGrid = $('#results').isotope({
    //     itemSelector: '.guide-item',
    //     layoutMode: 'fitRows'

    // });

    // // bind filter button click
    // $('.filters-button-group').on('click', 'button', function () {
    //     var filterValue = $(this).attr('data-filter');

    //     resultsGrid.isotope({ filter: filterValue });
    // });
    // // change is-checked class on buttons
    // $('.button-group').each(function (i, buttonGroup) {
    //     var $buttonGroup = $(buttonGroup);
    //     $buttonGroup.on('click', 'button', function () {
    //         $buttonGroup.find('.is-checked').removeClass('is-checked');
    //         $(this).addClass('is-checked');
    //     });
    // });




});


