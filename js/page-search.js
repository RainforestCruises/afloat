jQuery(document).ready(function ($) {
  $('#itinerary-select').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Select Itinerary",

  });

  $('#result-sort').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Select",
  });
});