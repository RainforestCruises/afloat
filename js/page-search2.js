jQuery(document).ready(function ($) {
  console.log(resultsArray);
  // Show More -- Departure List
  $("#departure-show-more").click(function (e) {
    $("#departure-filter-list").toggleClass("expanded");
    var isExpanded = $("#departure-filter-list").hasClass("expanded");
    if (isExpanded == true) {
      $('#departure-show-more').html("Show Less");
    } else {
      $('#departure-show-more').html("Show More");
    }
  });

  //intro expand/hide
  $(".search-intro__title").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    $this.parent().find('.search-intro__text').slideToggle(350);
    $this.toggleClass('search-intro__title--collapsed');
  });

  //filters expand/hide
  $(".filter__heading").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    $this.parent().find('.filter__content').slideToggle(350);
    $this.parent().find('.filter__heading').toggleClass('closed');
  });



  //FORM ----------------
  //form variables
  const formDates = document.querySelector('#formDates');
  const formTravelStyles = document.querySelector('#formTravelStyles');
  const formDestinations = document.querySelector('#formDestinations');
  const formExperiences = document.querySelector('#formExperiences');



  //Departure Date selections
  let departureString = "";
  const departureDatesArray = [...document.querySelectorAll('.departure-checkbox')];
  departureDatesArray.forEach(item => {
    item.addEventListener('click', () => {

      departureString = "";
      let count = 0;
      departureDatesArray.forEach(checkbox => {
        const itemMonth = checkbox.getAttribute("month");
        const itemYear = checkbox.getAttribute("year");

        if (checkbox.checked) {
          if (count > 0) {
            departureString += ":";
          }
          departureString += itemMonth + "-" + itemYear;
          count++;
        }

      })
      console.log(departureString);
      formDates.value = departureString;
    });
  })


  //Travel Style selections
  let travelStylesString = "";
  let travelStylesSelectionArray = [];
  const travelStylesArray = [...document.querySelectorAll('.travel-style-checkbox')];
  travelStylesArray.forEach(item => {
    item.addEventListener('click', () => {
      travelStylesSelectionArray = [];
      travelStylesString = "";
      let count = 0;
      travelStylesArray.forEach(checkbox => {
        const itemValue = checkbox.value;

        if (checkbox.checked) {

          travelStylesSelectionArray.push(itemValue);

          if (count > 0) {
            travelStylesString += ":";
          }
          travelStylesString += itemValue;
          count++;
        }

      })

      formTravelStyles.value = travelStylesString;

      filterResults();
    });
  })

  //Destination selections
  let destinationsString = "";
  const destinationsArray = [...document.querySelectorAll('.destination-checkbox')];
  destinationsArray.forEach(item => {
    item.addEventListener('click', () => {

      destinationsString = "";
      let count = 0;
      destinationsArray.forEach(checkbox => {
        const itemValue = checkbox.value;

        if (checkbox.checked) {
          if (count > 0) {
            destinationsString += ":";
          }
          destinationsString += itemValue;
          count++;
        }

      })
      console.log(destinationsString);
      formDestinations.value = destinationsString;
    });
  })

  //Experiences selections
  let experiencesString = "";
  let experiencesSelectionArray = [];
  const experiencesArray = [...document.querySelectorAll('.experience-checkbox')];
  experiencesArray.forEach(item => {
    item.addEventListener('click', () => {
      experiencesSelectionArray = [];
      experiencesString = "";
      let count = 0;
      experiencesArray.forEach(checkbox => {
        const itemValue = parseInt(checkbox.value) ;

        if (checkbox.checked) {

          experiencesSelectionArray.push(itemValue);

          if (count > 0) {
            experiencesString += ":";
          }
          experiencesString += itemValue;
          count++;
        }

      })
      formExperiences.value = experiencesString;
      filterResults();
    });
  })




  //Need function to filter list and prepare prices/length values based on filter inputs
  //Then pass to render function
  const filterResults = () => {

    let filteredList = resultsArray;
    

    //travel styles
    if (travelStylesSelectionArray.length > 0) {
      let list = [];
      resultsArray.forEach(o => {
        if(travelStylesSelectionArray.includes(o.postType)){
          list.push(o);
        };
        
      })
      filteredList = list;

    }

    //experiences
    if (experiencesSelectionArray.length > 0) {
      let list = [];
      filteredList.forEach(o => {

        arr1 = o.experiences.map(x => x.postId);
        arr2 = experiencesSelectionArray;
        const found = arr1.some(r=> arr2.indexOf(r) >= 0);
        if(found == true){
          list.push(o);
        }
  
      })
      filteredList = list;
    }

    renderResponse(filteredList);
  };



  //Render function
  const responseDiv = document.querySelector('#response');
  const renderResponse = (arr) => {
    responseDiv.innerHTML = "";
    arr.forEach(item => {

      var resultCard = document.createElement("a");
      resultCard.classList.add("search-result");
      resultCard.href = item.postLink;

      var resultHTML = `
      <div class="search-result__image">
        <img src="${item.featuredImage.url}" alt="">
      </div>
      <div class="search-result__content">
        <div class="search-result__content__tag">
          Amazing
        </div>
        <div class="search-result__content__length">
          1-Day Tour
        </div>
        <div class="search-result__content__title">
        ${item.propertyTitle}              
        </div>
        <div class="search-result__content__description">
        ${item.snippet} 
        </div>
        <div class="search-result__content__info">
            <div class="search-result__content__info__price">
                <div class="search-result__content__info__price__starting">
                    Starting from                     
                </div>
                <div class="search-result__content__info__price__amount">
                    $7,225                    
                </div>
                <div class="search-result__content__info__price__currency">
                    USD
                </div>
            </div>
            <div class="search-result__content__info__icons">
            </div>
        </div>
  </div>`









      resultCard.innerHTML = resultHTML;
      responseDiv.appendChild(resultCard);
    })
  }
  





  // <a class="search-result" href="https://rfcweb.azurewebsites.net/tours/15d-multi-classic-pe-bo/">
  //       <div class="search-result__image">
  //           <img src="https://res.cloudinary.com/rainforest-cruises/images/v1618598903/15D-South-America-PE-B0-Featured/15D-South-America-PE-B0-Featured.jpg" alt="">
  //       </div>
  //       <div class="search-result__content">
  //           <div class="search-result__content__tag">

  //                                           </div>
  //           <div class="search-result__content__length">
  //                                   1-Day Tour
  //                           </div>
  //           <div class="search-result__content__title">
  //                                   Inca Trail &amp; Salar Uyuni                
  //           </div>
  //           <div class="search-result__content__description">
  //                           </div>
  //           <div class="search-result__content__info">
  //               <div class="search-result__content__info__price">
  //                   <div class="search-result__content__info__price__starting">
  //                       Starting from                     </div>
  //                   <div class="search-result__content__info__price__amount">
  //                       $7,225                    </div>
  //                   <div class="search-result__content__info__price__currency">
  //                       USD
  //                   </div>
  //               </div>
  //               <div class="search-result__content__info__icons">
  //               </div>
  //           </div>
  //       </div>
  //   </a>
});


