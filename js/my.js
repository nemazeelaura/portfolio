$(document).ready(function() {


    $(function(){
      //changing movienight to back of postcard on click    
              $('#more').click(function() {
                   $('#change').attr('src', 'img/animate/movieback.png'); 
             });

              $('#more1').click(function() {
                   $('#change1').attr('src', 'img/animate/xmaslight600.png'); 
             });

               $('#more2').click(function() {
                   $('#change2').attr('src', 'img/animate/bellacoupon.png'); 
             });
                $('#more3').click(function() {
                   $('#change3').attr('src', 'img/animate/march2cc.png'); 
             });

          });
  
  animationClick('img', 'rotateIn'); // adding animate to images on click

function animationClick(element, animation){
  element = $(element);
  element.click(
    function() {
      element.addClass('animated ' + animation);
      //wait for animation to finish before removing classes
      window.setTimeout( function(){
          element.removeClass('animated ' + animation);
      }, 2000);
    }
  );
}


});
