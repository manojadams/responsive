/*=======================================Rating System====================================*/
$(document).ready(function(){
	$('.userRating').hover(function(){
		$(this).parent().find('.rating-wrapper').toggle();
	});
});