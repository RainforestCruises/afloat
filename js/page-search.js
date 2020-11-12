jQuery(document).ready(function ($) {
  $('#destination-select').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Select Destination",

  });

  $('#result-sort').select2({
    width: 'auto',
    dropdownAutoWidth: true,
    minimumResultsForSearch: -1,
    placeholder: "Sort",
  });

  //selection controls
  $('#destination-select').on('change', function () {
    var destinationId = $(this).val();
    console.log(destinationId);
    $('#search-form').submit();
  });

  //result-sort
  $('#result-sort').on('change', function () {
    $('#search-form').submit();
  });

  $(function () {
    $('input[name="departure-dates"]').daterangepicker({
      ignoreReadonly: true,
      startDate: moment(),
      endDate: moment().add(1, 'M'),
      locale: {
        format: 'MMM DD, YYYY'
      }
    }), function (start, end) {

    };
  });


  $(function () {
    $('input[name="departure-dates"]').daterangepicker({
      startDate: moment(),
      endDate: moment().add(1, 'M'),
      locale: {
        format: 'MMM DD, YYYY'
      }
    }, function (start, end) {
      $("#startDate").val(start.format('YYYY-MM-DD'))
      $("#endDate").val(end.format('YYYY-MM-DD'))
      reloadResults();


    });
  });
  $("#startDate").val(moment().format('YYYY-MM-DD'))
  $("#endDate").val(moment().add(1, 'M').format('YYYY-MM-DD'))


  reloadResults(); //first time page loads
  $('#search-form').submit(function () {
    reloadResults();
    return false;
  });

  //SEARCH FUNCTION
  function reloadResults() {
    var searchForm = $('#search-form'); //get form
    console.log(searchForm);
    $.ajax({
      url: searchForm.attr('action'),
      data: searchForm.serialize(), // form data
      type: searchForm.attr('method'), // POST
      beforeSend: function () {
        $('#response').html('<div class="search-results__grid__loading"><div class="lds-dual-ring"></div></div>'); //loading spinner
      },
      success: function (data) {
        $('#response').html(data); // insert data
      }
    });
    //return false;
  }








  // $("#destination-select").select2().on("select2-open", () => {
  //   let oldSearchBox = $(".select2-focused")[0]; //Get the current search box
  //   let parent = oldSearchBox.parentNode; //The parent of the search box (i.e. the element that holds it)

  //   let search = document.createElement("input"); //Create a new input box
  //   search.classList.add("select2-input"); //Make it look like the old one
  //   search.addEventListener("keyup", () => { //Whenever someone releases a key, filter the results
  //     let results = parent.parentNode.getElementsByClassName("select2-result"); //Get all of the select box options
  //     let query = search.value.toLowerCase(); //Get what the user has typed (in lower case so search is case-insensitive)
  //     for (let result of results) { //Loop through all of the select box options
  //       let resultText = result.children[0].childNodes[1].nodeValue.toLowerCase(); //Get the text for that option (also in lower case)
  //       result.style.display = (resultText.indexOf(query) == -1) ? "none" : "block"; //If the result text contains the search, it is displayed, otherwise it is hidden
  //     }
  //   })

  //   parent.appendChild(search); //Add the new search box to the page
  //   oldSearchBox.remove(); //Remove the old one
  // });

  // $("#destination-select").select2().on("select2-close", () => {
  //   setTimeout(() => {
  //     $(":focus").blur();
  //   }, 50);
  // });


});


