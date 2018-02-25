// $(document).ready(function() {

//   $(function(){
//  		//animate on click         
//     $('#animateBtn2').click(function() {
//        animate('header', 'slideOut');
//         setTimeout(function() {
//          $('header').css('visibility', 'hidden');
//        }, 1000);
//        return false;
//     });
//  			//animate
//  			function animate(element, animation){
//         $(element).addClass('animated', +animation);
//           var wait = setTimeout(function(){
//             $(element).removeClass('animated ' +animation);
//             }, 1000); //wait then remove animation
//  			  }
//  		});
// }); 

$(document).ready(function() {


    $(function(){
      //animate on click         
              $('#animateBtn2').click(function() {
                 animate('#b1', 'rotateIn');
                 setTimeout(function() {
                   $('header').css('visibility', 'hidden');
                 }, 1000);
                 return false;
             });
      //animate
      function animate(element, animation){
              $(element).addClass('animated', +animation);
              var wait = setTimeout(function(){
                $(element).removeClass('animated ' +animation);
              }, 1000); //wait then remove animation
      }
    });
  
  
//   animationClick('#b1', 'rotateIn'); // adding animate to my story images on click

// function animationClick(element, animation){
//   element = $(element);
//   element.click(
//     function() {
//       element.addClass('animated ' + animation);
//       //wait for animation to finish before removing classes
//       window.setTimeout( function(){
//           element.removeClass('animated ' + animation);
//       }, 2000);
//     }
//   );
// };

 

});


