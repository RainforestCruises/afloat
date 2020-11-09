jQuery(document).ready(function ($) {
  $('#destination-select').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Select Destination",

  });

  $('#result-sort').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Select",
  });


  reloadResults(); //first time page loads
  $('#search-form').submit(function () {
    reloadResults();
    return false;
  });

  //SEARCH FUNCTION
  function reloadResults() {
    var searchForm = $('#search-form'); //get form
    $.ajax({
      url: searchForm.attr('action'),
      data: searchForm.serialize(), // form data
      type: searchForm.attr('method'), // POST

      success: function (data) {
        $('#response').html(data); // insert data
  
      }
    });
    //return false;
  }


});


