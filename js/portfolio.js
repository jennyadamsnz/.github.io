
            if ($(window).width() <= 390){
                $(window).scroll(function() {

                    var scroll = $(window).scrollTop();

                    if (scroll >= ($(document).height()*0.1)) {
                        console.log("hello");
                        $('.first_overlay').css("opacity", "0");
                        $('.first_underlay').css("opacity", "1");
                    };

                    if (scroll < ($(document).height()*0.1)) {
                        $('.first_overlay').css("opacity", "1");
                        $('.first_underlay').css("opacity", "0");       
                    };  

                    if (scroll >= ($(document).height()*0.2)) {
                        $('.second_overlay').css("opacity", "0");
                        $('.second_underlay').css("opacity", "1");

                        $('.first_overlay').css("opacity", "1");
                        $('.first_underlay').css("opacity", "0");                           
                    };

                    if (scroll < ($(document).height()*0.2)) {
                        $('.second_overlay').css("opacity", "1");
                        $('.second_underlay').css("opacity", "0");      
                    };                          

                    if (scroll >= ($(document).height()*0.3)) {
                        $('.third_overlay').css("opacity", "0");
                        $('.third_underlay').css("opacity", "1");

                        $('.second_overlay').css("opacity", "1");
                        $('.second_underlay').css("opacity", "0");                      
                    };          

                    if (scroll < ($(document).height()*0.3)) {
                        $('.third_overlay').css("opacity", "1");
                        $('.third_underlay').css("opacity", "0");       
                    };                                                    

                    if (scroll >= ($(document).height()*0.45)) {
                        $('.fourth_overlay').css("opacity", "0");
                        $('.fourth_underlay').css("opacity", "1");                              
                        $('.third_overlay').css("opacity", "1");
                        $('.third_underlay').css("opacity", "0");                   
                    };        

                    if (scroll < ($(document).height()*0.45)) {
                        $('.fourth_overlay').css("opacity", "1");
                        $('.fourth_underlay').css("opacity", "0");      
                    };  

                });
            };       

            // Highlight boxes according to screen size and scroll height

            if ($(window).width() > 390 && $(window).width() < 550){

                $(window).scroll(function() {

                    var scroll = $(window).scrollTop(); 

                    if (scroll >= ($(document).height()*0.1)) {
                        $('.first_overlay').css("opacity", "0");
                        $('.first_underlay').css("opacity", "1");
                    };

                    if (scroll < ($(document).height()*0.1)) {
                        $('.first_overlay').css("opacity", "1");
                        $('.first_underlay').css("opacity", "0");       
                    };  

                    if (scroll >= ($(document).height()*0.25)) {
                        $('.second_overlay').css("opacity", "0");
                        $('.second_underlay').css("opacity", "1");

                        $('.first_overlay').css("opacity", "1");
                        $('.first_underlay').css("opacity", "0");                           
                    };

                    if (scroll < ($(document).height()*0.25)) {
                        $('.second_overlay').css("opacity", "1");
                        $('.second_underlay').css("opacity", "0");      
                    };                           

                    if (scroll >= ($(document).height()*0.4)) {
                        $('.third_overlay').css("opacity", "0");
                        $('.third_underlay').css("opacity", "1");

                        $('.second_overlay').css("opacity", "1");
                        $('.second_underlay').css("opacity", "0");                      
                    };          

                    if (scroll < ($(document).height()*0.40)) {
                        $('.third_overlay').css("opacity", "1");
                        $('.third_underlay').css("opacity", "0");       
                    };                                                    

                    if (scroll >= ($(document).height()*0.51)) {
                        $('.fourth_overlay').css("opacity", "0");
                        $('.fourth_underlay').css("opacity", "1");                              
                        $('.third_overlay').css("opacity", "1");
                        $('.third_underlay').css("opacity", "0");                   
                    };        

                    if (scroll < ($(document).height()*0.51)) {
                        $('.fourth_overlay').css("opacity", "1");
                        $('.fourth_underlay').css("opacity", "0");      
                    };   

                });    
            };

            if ($(window).width() > 550 && $(window).width() < 700){
 
                $(window).scroll(function() { 

                    var scroll = $(window).scrollTop(); 

                    if (scroll >= ($(document).height()*0.015)) {
                        $('.first_overlay').css("opacity", "0");
                        $('.first_underlay').css("opacity", "1");
                    };

                    if (scroll < ($(document).height()*0.015)) {
                        $('.first_overlay').css("opacity", "1");
                        $('.first_underlay').css("opacity", "0");       
                    };  

                    if (scroll >= ($(document).height()*0.035)) {
                        $('.second_overlay').css("opacity", "0");
                        $('.second_underlay').css("opacity", "1");

                        $('.first_overlay').css("opacity", "1");
                        $('.first_underlay').css("opacity", "0");                           
                    }; 

                    if (scroll < ($(document).height()*0.035)) {
                        $('.second_overlay').css("opacity", "1");
                        $('.second_underlay').css("opacity", "0");      
                    };                           

                    if (scroll >= ($(document).height()*0.06)) {
                        $('.third_overlay').css("opacity", "0");
                        $('.third_underlay').css("opacity", "1");

                        $('.second_overlay').css("opacity", "1");
                        $('.second_underlay').css("opacity", "0");                      
                    };            

                    if (scroll < ($(document).height()*0.06)) {
                        $('.third_overlay').css("opacity", "1");
                        $('.third_underlay').css("opacity", "0");       
                    };                                                     

                    if (scroll >= ($(document).height()*0.085)) {
                        $('.fourth_overlay').css("opacity", "0");
                        $('.fourth_underlay').css("opacity", "1");                              
                        $('.third_overlay').css("opacity", "1");
                        $('.third_underlay').css("opacity", "0");                   
                    };        

                    if (scroll < ($(document).height()*0.085)) {
                        $('.fourth_overlay').css("opacity", "1");
                        $('.fourth_underlay').css("opacity", "0");      
                    };    

                });   
            };

            if ($(window).width() > 700 && $(window).width() < 768){
 
                $(window).scroll(function() { 

                    var scroll = $(window).scrollTop(); 

                    if (scroll >= ($(document).height()*0.0425)) {
                        $('.first_overlay').css("opacity", "0");
                        $('.first_underlay').css("opacity", "1");
                    };

                    if (scroll < ($(document).height()*0.0425)) {
                        $('.first_overlay').css("opacity", "1");
                        $('.first_underlay').css("opacity", "0");       
                    };  

                    if (scroll >= ($(document).height()*0.085)) {
                        $('.second_overlay').css("opacity", "0");
                        $('.second_underlay').css("opacity", "1");

                        $('.first_overlay').css("opacity", "1");
                        $('.first_underlay').css("opacity", "0");                           
                    }; 

                    if (scroll < ($(document).height()*0.085)) {
                        $('.second_overlay').css("opacity", "1");
                        $('.second_underlay').css("opacity", "0");      
                    };                           

                    if (scroll >= ($(document).height()*0.1275)) {
                        $('.third_overlay').css("opacity", "0");
                        $('.third_underlay').css("opacity", "1");

                        $('.second_overlay').css("opacity", "1");
                        $('.second_underlay').css("opacity", "0");                      
                    };            

                    if (scroll < ($(document).height()*0.1275)) {
                        $('.third_overlay').css("opacity", "1");
                        $('.third_underlay').css("opacity", "0");       
                    };                                                     

                    if (scroll >= ($(document).height()*0.17)) {
                        $('.fourth_overlay').css("opacity", "0");
                        $('.fourth_underlay').css("opacity", "1");                              
                        $('.third_overlay').css("opacity", "1");
                        $('.third_underlay').css("opacity", "0");                   
                    };        

                    if (scroll < ($(document).height()*0.17)) {
                        $('.fourth_overlay').css("opacity", "1");
                        $('.fourth_underlay').css("opacity", "0");      
                    };    

                });   
            };          


            if ($(window).width() > 768 && $(window).width() < 1000){
 
                $(window).scroll(function() { 

                    var scroll = $(window).scrollTop(); 

                    if (scroll >= ($(document).height()*0.1)) {
                        $('.first_overlay').css("opacity", "0");
                        $('.first_underlay').css("opacity", "1");
                    };

                    if (scroll < ($(document).height()*0.1)) {
                        $('.first_overlay').css("opacity", "1");
                        $('.first_underlay').css("opacity", "0");       
                    };  

                    if (scroll >= ($(document).height()*0.16667)) {
                        $('.second_overlay').css("opacity", "0");
                        $('.second_underlay').css("opacity", "1");

                        $('.first_overlay').css("opacity", "1");
                        $('.first_underlay').css("opacity", "0");                           
                    }; 

                    if (scroll < ($(document).height()*0.16667)) {
                        $('.second_overlay').css("opacity", "1");
                        $('.second_underlay').css("opacity", "0");      
                    };                           

                    if (scroll >= ($(document).height()*0.2)) {
                        $('.third_overlay').css("opacity", "0");
                        $('.third_underlay').css("opacity", "1");

                        $('.second_overlay').css("opacity", "1");
                        $('.second_underlay').css("opacity", "0");                      
                    };            

                    if (scroll < ($(document).height()*0.2)) {
                        $('.third_overlay').css("opacity", "1");
                        $('.third_underlay').css("opacity", "0");       
                    };                                                     

                    if (scroll >= ($(document).height()*0.3)) {
                        $('.fourth_overlay').css("opacity", "0");
                        $('.fourth_underlay').css("opacity", "1");                              
                        $('.third_overlay').css("opacity", "1");
                        $('.third_underlay').css("opacity", "0");                   
                    };        

                    if (scroll < ($(document).height()*0.3)) {
                        $('.fourth_overlay').css("opacity", "1");
                        $('.fourth_underlay').css("opacity", "0");      
                    };    

                });   
            }; 

            // Display Contact Info

            if ($(window).width() > 350){
                $("#phone").click(function() {
                    $('.contactDetails').text("027 556 9938");
                });              
                // $("#phone").blur(function() {
                //     console.log("hello");
                //     if($('.contactDetails').text(!=== (null)){
                //         console.log("hello2");
                //         $('.contactDetails').text("");
                //     }    
                // });  
                $("#email").click(function() {
                    $('.contactDetails').text("jennyadamsnz@gmail.com");
                });                       
            };
   