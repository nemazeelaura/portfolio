$(document).ready(function() {

  
  
  animationClick('.first-image', 'rotateIn'); // adding animate to my story images on click

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
};

    $(function(){

      function animate(element, animation) {
         $(element).addClass('animated ' +animation);
         var wait =setTimeout(function() {
          $(element).removeClass('animate' +animation);
         })
    }

  })

 




});


