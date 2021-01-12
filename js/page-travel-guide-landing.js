jQuery(document).ready(function ($) {

    console.log('boom')

    // external js: isotope.pkgd.js

    // init Isotope
    var resultsGrid = $('#results').isotope({
        itemSelector: '.guide-item',
        layoutMode: 'fitRows'
        
    });

    // bind filter button click
    $('.filters-button-group').on('click', 'button', function () {
        var filterValue = $(this).attr('data-filter');
      
        resultsGrid.isotope({ filter: filterValue });
    });
    // change is-checked class on buttons
    $('.button-group').each(function (i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', 'button', function () {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });

});


