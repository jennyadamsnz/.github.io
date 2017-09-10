
  // ================DROPDOWN MENUS===============
  
  var shift = document.querySelector('.shift');
 
  var titleElement = shift.querySelectorAll('.title');
 
  for(var i=0; i < titleElement.length; i ++){
 
    titleElement[i].addEventListener("click", function(e){
 
      var element = e.target;
 
      console.log(element);
      var dropDown = shift.querySelector('#'+element.id+"-Dropdown");
      dropDown.classList.toggle("show");
    });
     
  }

  // ================AUTO DROPDOWN FOR MAP TABS===============

  function getQueryVariable(variable)
  {
         var query = window.location.search.substring(1);
         var vars = query.split("&");
         for (var i=0;i<vars.length;i++) {
                 var pair = vars[i].split("=");
                 if(pair[0] == variable){return pair[1];}
         }
         return(false);
  }

  if( getQueryVariable('startmap') ) {
    
    document.querySelector('#map_here-Dropdown').classList.toggle('show');
  }