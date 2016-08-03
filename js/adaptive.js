 $(document).ready(function() {
	
	
	if($(window).width() >= 1045) {
			$(".slick-slider .slick-track, .slick-slider .slick-list").css("width","600px");
			$(".slick-dotted.slick-slider ").css("width","640px");
			$(".description").css("width","600px");
			$(".slider-for img").show();
		}
		else if($(window).width() <= 1044 && $(window).width() >= 943 ) {
			$(".slick-slider .slick-track, .slick-slider .slick-list").css("width","500px");
			$(".slick-dotted.slick-slider ").css("width","540px");
			$(".description").css("width","500px");
			$(".slider-for img").show();
		}
		
		else if($(window).width() <= 942 && $(window).width() >= 883 ) {
			$(".slick-slider .slick-track, .slick-slider .slick-list").css("width","400px");
			$(".slick-dotted.slick-slider ").css("width","440px");
			$(".description").css("width","400px");
			$(".slider-for img").show();
		}
		
		else if($(window).width() <= 884 && $(window).width() >= 601) {
			$(".slick-slider .slick-track, .slick-slider .slick-list").css("width","300px");
			$(".slick-dotted.slick-slider ").css("width","340px");
			$(".description").css("width","300px");
			$(".slider-for img").hide();
			
		}
		else if ($(window).width() <= 600 && $(window).width() >= 320) {
			$(".main_menu img").hide();
			$(".slider-for img").hide();
			$(".arrprev1").show();
			$(".arrnext1").show();
			$(".description").css("width","200px");
			$(".slick-dotted.slick-slider ").css("width","240px");
			$(".slick-slider .slick-track, .slick-slider .slick-list").css("width","200px");
		}
		
		else if ($(window).width() <= 320 ) {
			$(".main_menu img").hide();
			$(".slider-for img").hide();
			$(".arrprev1").show();
			$(".arrnext1").show();
			$(".description").css("width","200px");
			$(".slick-dotted.slick-slider ").css("width","240px");
			$(".slick-slider .slick-track, .slick-slider .slick-list").css("width","200px");
			
		}
	
	$(window).resize(function(){
		
		if($(window).width() >= 1045) {
			$(".slick-slider .slick-track, .slick-slider .slick-list").css("width","600px");
			$(".slick-dotted.slick-slider ").css("width","640px");
			$(".description").css("width","600px");
			$(".slider-for img").show();
			$(".main_menu img").css("display","inline-block");
		}
		else if($(window).width() <= 1044 && $(window).width() >= 943 ) {
			$(".slick-slider .slick-track, .slick-slider .slick-list").css("width","500px");
			$(".slick-dotted.slick-slider ").css("width","540px");
			$(".description").css("width","500px");
			$(".slider-for img").show();
			$(".main_menu img").css("display","inline-block");
		}
		
	else if($(window).width() <= 942 && $(window).width() >= 883 ) {
			$(".slick-slider .slick-track, .slick-slider .slick-list").css("width","400px");
			$(".slick-dotted.slick-slider ").css("width","440px");
			$(".description").css("width","400px");
			$(".slider-for img").show();
		}
		
		else if($(window).width() <= 884 && $(window).width() >= 601) {
			$(".slick-slider .slick-track, .slick-slider .slick-list").css("width","300px");
			$(".slick-dotted.slick-slider ").css("width","340px");
			$(".description").css("width","300px");
			$(".slider-for img").hide();
			
		}
		else if ($(window).width() <= 600 && $(window).width() >= 320) {
			$(".main_menu img").hide();
			$(".slider-for img").hide();
			$(".arrprev1").show();
			$(".arrnext1").show();
			$(".description").css("width","200px");
			$(".slick-dotted.slick-slider ").css("width","240px");
			$(".slick-slider .slick-track, .slick-slider .slick-list").css("width","200px");
		}
		
		else if ($(window).width() <= 320) {
			$(".main_menu img").hide();
			$(".slider-for img").hide();
			$(".arrprev1").show();
			$(".arrnext1").show();
			$(".description").css("width","200px");
			$(".slick-dotted.slick-slider ").css("width","240px");
			$(".slick-slider .slick-track, .slick-slider .slick-list").css("width","200px");
			
			
		}
	});
	
	$(window).scroll(function() {
		if($(this).width() <= 600 ) {
			$(".main_menu img").hide();
			$(".arrprev1").show();
			$(".arrnext1").show();
			$(".main_menu").removeClass("stickMenu");
			
		}
		
	});
});