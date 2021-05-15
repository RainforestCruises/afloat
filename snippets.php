filteredList.forEach(o => {
        if (o.postType != 'rfc_cruises') {
          list.push(o);
        }
        else { //cruises
          console.log('filter-cruise-departures');
          o.itineraries.forEach(i => {

            let newDeparturesList = [];

            i.departures.forEach(d => {
              
              departureSelectionArray.forEach(s => {

                var startTime = new Date(s);
                var ds = startTime.getTime()

                var endTime = new Date(startTime.setMonth(startTime.getMonth()+1))
                var de = startTime.getTime()

                var departureDate = new Date(d.departureDate);
                var dd = departureDate.getTime();

                // console.log(startTime);
                // console.log(endTime);

                if(dd > ds && dd < de){
                  newDeparturesList.push(d);
                }
                
              })
        

              // if(found == true){
              //   newDeparturesList.push(d);
              // }
              // for (var x = 0; x < departureSelectionArray.length; x++) {
              //   var match = moment(d.departureDate).isSame(departureSelectionArray[x], 'month');
              //   //console.log(departureSelectionArray[x]);
              //   if(match == true){
              //     found = true;                              
              //   }
              // }
              // if(found==true){
              //   newDeparturesList.push(d);
              // }

            });

            i.departures = newDeparturesList;

          })

          list.push(o);

        }
      })