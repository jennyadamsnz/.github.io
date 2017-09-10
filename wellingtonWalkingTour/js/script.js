// ================ NEW MAPS ==================


    function firstMap() {
      var directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
      var directionsService = new google.maps.DirectionsService;   

       if ( $(window).width() > 500) {
        // Tablet / Desktop
         var center = {lat: -41.294157, lng: 174.783441};
       } else {
        // Mobile
         var center = {lat: -41.293998, lng: 174.782179};
       }

      var map = new google.maps.Map(document.getElementById('firstmap'), {
        zoom: 15,
        center: center
      });

      directionsDisplay.setMap(map);

      window.onresize = function(event) {
         map.setCenter({lat: -41.294157, lng: 174.783441});
      };

      if ( $(window).width() > 768) {     
        var image = {
          url: 'images/lrgtripodmarker.png',
          size: new google.maps.Size(300, 193),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(12.5, 105.27)
        }
        var center = {

        }
      } else {
        var image = {
            url: 'images/smltripodmarker.png',
            size: new google.maps.Size(176, 128),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(163, 36)
        }
      }

        var endMarkerOptions = {
          position: {lat: -41.294157, lng: 174.783441},
          map: map, 
          icon: image       
        }

        // Create marker      
        var EndMarker = new google.maps.Marker(endMarkerOptions);

      //calculateAndDisplayRoute(directionsService, directionsDisplay);

      document.getElementById('firstmode').addEventListener('change', function() {
        calculateAndDisplayRouteFirstMap(directionsService, directionsDisplay);
      });

      secondMap();
    }

    function calculateAndDisplayRouteFirstMap(directionsService, directionsDisplay) {
      var selectedMode = document.getElementById('firstmode').value;

      // If the value is blank
      if( selectedMode == '') {
        return;
      }
      
      if( navigator.geolocation){

        navigator.geolocation.getCurrentPosition(function(position){

           var userData = {
              lat: position.coords.latitude,
              lng: position.coords.longitude, 
            }; 

            // var startMarkerOptions = {
            //   position: {userData},
            //   icon : (
            //    // URL
            //    'images/start_icon.png',
            //    // (width,height)
            //    new google.maps.Size( 30, 20 ),
            //    // The origin point (x,y)
            //    new google.maps.Point( 0, 0 ),
            //    // The anchor point (x,y)
            //    new google.maps.Point( 30, 10 )
            //   )};

            // var startMarker = new google.maps.Marker(startMarkerOptions); 
        

            directionsService.route({
            origin: {lat: userData.lat, lng: userData.lng},  
            destination: {lat: -41.294157, lng: 174.783441},  

            travelMode: google.maps.TravelMode[selectedMode]
          }, function(response, status) {
            if (status == 'OK') {
              directionsDisplay.setDirections(response);
            } else {
              window.alert('Directions request failed due to ' + status);
            }
          });
        });            
      }    
    }

    function secondMap() {
      var directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
      var directionsService = new google.maps.DirectionsService;

             if ( $(window).width() > 500) {
        // Tablet / Desktop
         var center = {lat: -41.298281, lng: 174.777504};
       } else {
        // Mobile
         var center = {lat: -41.298281, lng: 174.777504};
       }

      var map = new google.maps.Map(document.getElementById('secondmap'), {
        zoom: 15,
        center: center
      });

      directionsDisplay.setMap(map);

      window.onresize = function(event) {
         map.setCenter({lat: -41.298281, lng: 174.777504});
      };

      if ( $(window).width() > 768) {     
        var image = {
          url: 'images/lrgmonumentmarker.png',
          size: new google.maps.Size(300, 199),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(288.89, 103.48)
        }
        var center = {

        }
      } else {
        var image = {
            url: 'images/smlmonumentmarker.png',
            size: new google.maps.Size(176, 128),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(163, 36)
        }
      }      

       var endMarkerOptions = {
          position: {lat: -41.298281, lng: 174.777504},
          map: map,        
          icon: image
        }

        // Create marker      
        var EndMarker = new google.maps.Marker(endMarkerOptions);

      document.getElementById('secondmode').addEventListener('change', function() {
        calculateAndDisplayRouteSecondMap(directionsService, directionsDisplay);
      });
    }

    function calculateAndDisplayRouteSecondMap(directionsService, directionsDisplay) {
      var selectedMode = document.getElementById('secondmode').value;

      // If the value is blank
      if( selectedMode == '') {
        return;
      }
      
      if( navigator.geolocation){

        navigator.geolocation.getCurrentPosition(function(position){

           var userData = {
              lat: position.coords.latitude,
              lng: position.coords.longitude, 

            };

            directionsService.route({
            origin: {lat: userData.lat, lng: userData.lng}, 
            destination: {lat: -41.298281, lng: 174.777504},  


            travelMode: google.maps.TravelMode[selectedMode]
          }, function(response, status) {
            if (status == 'OK') {
              directionsDisplay.setDirections(response);
            } else {
              window.alert('Directions request failed due to ' + status);
            }
          });

        });

      }
    }    

// ================ HAMBURGER MENU ICON ANIMATION ===============
  
  var hamburgerElement = document.querySelector('#hamburger_menu');

    hamburgerElement.addEventListener("click", function(e){

      var element = e.target;
      var expand = document.querySelector(".hamburgeranimation");
      expand.classList.toggle("open");
    });

// ================ HAMBURGER MENU APPEAR ===============

    hamburgerElement.addEventListener("click", function(e){

      var element = e.target;
      var expand = document.querySelector("#hamburger_menu-expand");
      expand.classList.toggle("reveal");
    });
    

// ======================== BLUR =======================

  hamburgerElement.addEventListener("click", function(e){

      var target = document.getElementById("blurhere");
      if (target.className === "noblur"){
          target.className = "blur";
      } else {
        target.className = "noblur";
      }    
  });


// ======================== GREY =======================

  hamburgerElement.addEventListener("click", function(e){

      var target = document.getElementById("greyhere");
      if (target.className === "nogrey"){
          target.className = "grey";
      } else {
        target.className = "nogrey";
      }    
  });

// ================ FORM VALIDATION ==================

function formValidation(theForm){
  console.log(theForm);
    // turn off basic html validation
    theForm.noValidate = true;

    theForm.addEventListener('blur', function(evt) {
      if(validateForm(theForm) === false){
              evt.preventDefault();
          } 
    }, true);

    theForm.addEventListener('submit', function(evt) {
      if(validateForm(theForm) === false){
              evt.preventDefault();
          } 
    }, true);

      function validateForm(theForm){
        // assume initially there are no errors
          var isError = false;
          // get elements from the form
          var elements = theForm.elements;
          // traverse through the array to get fields and check if it is valid
           for (var i = 0; i < elements.length; i += 1) {
              var isValid = isFieldValid(elements[i]);
               if(isValid === false){
                      isError = true;
                  }      
           }
           return ! isError;
      }

  function isFieldValid(field){

    var errorMessage = "";


    // skip fields that need not be validated
    if(! needsToBeValidated(field)){
      return true;
    }
    // checking for developer screw-ups
    if(field.id.length === 0 || field.name.length === 0){
      console.error("error", "field should have an ID and name attributes")
      return false;
    }
    if(document.querySelector("#"+field.id+"-error") === null){
      console.error("error: ", "A span field should be provided");
      return false;
    }

    // reset error message and error fields
    field.classList.remove('invalid');
    var errorSpan = document.querySelector("#"+field.id+"-error");
    errorSpan.innerHTML = ""; 
    errorSpan.classList.remove('warning');  

    //======================min value check=================

    if(field.minLength > 0 && field.value.length < field.minLength){
      errorMessage = "Must be at least " + field.minLength +" or more characters long.";
    }

    //=======================check email====================

    if(field.type === "email" && ! isEmail(field.value)){
      errorMessage = "Please provide a proper email";
    }

    //=======================check if the form element is blank====================

    if(field.required && field.value.trim() === ""){
      errorMessage = "This field is required";
    }

    //==================check for error message==================
    if(errorMessage !== ""){
      // generate error field
      field.classList.add('invalid');

      //display error message in form
      var errorSpan = document.querySelector("#"+field.id+"-error");
      errorSpan.innerHTML = errorMessage;
      errorSpan.classList.add('warning');

      return false;
    }
    return true; 

  }
  function needsToBeValidated(field){
    var skipElements = ['button', 'submit'];
    if(skipElements.indexOf(field.type) === -1){
      return true;
    } else {
      return false;
    }
  }
  function isEmail(input){
    console.log(input.match(/^([a-z0-9_.\-+]+)@([\da-z.\-]+)\.([a-z\.]{2,})$/));
    return input.match(/^([a-z0-9_.\-+]+)@([\da-z.\-]+)\.([a-z\.]{2,})$/);
    }
  } 

