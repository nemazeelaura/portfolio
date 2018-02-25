$(document).ready(function() {

  $(function(){
 		//animate on click         
    $('#animateBtn2').click(function() {
       animate('header', 'slideOut');
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
}); 