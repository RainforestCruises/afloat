$(document).ready(function() {
    $('#destination').select2({
        width: '100%',
        //multiple: 'true',
        //placeholder: 'Select a Destination',
        //minimumResultsForSearch: -1
      });

      $('#sort-by').select2({
        width: '100%',
        minimumResultsForSearch: -1
      });


      $('#travel-type').select2({
        width: '100%',
        minimumResultsForSearch: -1
      });

      $('#travel-style').select2({
        width: '100%',
        minimumResultsForSearch: -1
      });
});