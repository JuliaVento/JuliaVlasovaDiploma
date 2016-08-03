$(document).ready(function() {

	$(window).scroll(function() {
		
		if($(window).width() <= 600) {
			
			$(".main_menu").removeClass("stickMenu");
			$("#menu").removeClass("stickLeftMenu");
			$(".icon img").hide();
			$(".crutch").hide();	
			$(".sideMenHidden").hide();
			$("#menu").removeClass("animated fadeInDown");
			$("#menu").removeClass("animated fadeInUp");
		}
		else {
			if($(window).scrollTop() > $(".main_menu").height() + $(".header").height()) {
				$(".crutch").show();
				$(".main_menu").addClass("stickMenu");
				$(".icon img").hide();
				$(".main_menu li").addClass("annulli");
				$(".main_menu li:first-child").addClass("annul");
				$(".main_menu li:first-child").css("float","none");
				$(".main_menu li").css("display","inline-block");
				$(".main_menu li").css("float","none");
				if($(window).scrollTop() > $(".logo").height() + $("#menu").height()) {
					$(".sideMenHidden").show();
					$("#menu").addClass("stickLeftMenu");
					$("#menu").addClass("animated fadeInDown");
					
				}
				else if ($(window).scrollTop() < $(".logo").height() + $("#menu").height() / 2){
					$(".sideMenHidden").hide();
					$("#menu").removeClass("stickLeftMenu");
					$("#menu").removeClass("animated fadeInDown");
					
				}
			}
			
			
			else {
				$(".main_menu").removeClass("stickMenu");
				$(".crutch").hide();
				$(".icon img").css("display","inline-block");
				$(".main_menu li").removeClass("annulli");
				$(".main_menu li:first-child").removeClass("annul");
				$(".main_menu li:first-child").css("float","left");
				$(".main_menu li").css("display","inline");
				$(".main_menu li").css("float","left");
				
		
			}
			
			
		
		}
		
		
		
		
		
		
		
	});
	
});



/*
var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   if (st > lastScrollTop){
       // downscroll code
   } else {
      // upscroll code
   }
   lastScrollTop = st;
});





var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel" //FF doesn't recognize mousewheel as of FF3.x
$('#yourDiv').bind(mousewheelevt, function(e){

    var evt = window.event || e //equalize event object     
    evt = evt.originalEvent ? evt.originalEvent : evt; //convert to originalEvent if possible               
    var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta //check for detail first, because it is used by Opera and FF

    if(delta > 0) {
        //scroll up
    }
    else{
        //scroll down
    }   
});





 $(document).ready(function() {

	$(window).scroll(function() {
		
		if($(window).width() <= 600) {
			
			$(".main_menu").removeClass("stickMenu");
			$("#menu").removeClass("stickLeftMenu");
			$(".icon img").hide();
			$(".crutch").hide();	
			$(".sideMenHidden").hide();
			
		}
		else {
			if($(window).scrollTop() > $(".main_menu").height() + $(".header").height() + 100) {
			$(".crutch").show();
			$(".main_menu").addClass("stickMenu");
			$(".icon img").hide();
			$(".main_menu li").addClass("annulli");
			$(".main_menu li:first-child").addClass("annul");
			$(".main_menu li:first-child").css("float","none");
			$(".main_menu li").css("display","inline-block");
			$(".main_menu li").css("float","none");
				if($(window).scrollTop() > $(".logo").height() + $("#menu").height() + 100) {
				$(".sideMenHidden").show();
				
				$("#menu").addClass("stickLeftMenu");
				
				$("#menu").addClass("animated fadeInDown");
				}
				else {
					
					
					$(".sideMenHidden").hide();
					
					$("#menu").removeClass("stickLeftMenu");
					$("#menu").removeClass("animated fadeInDown");
					
				}
			}
			
			
			else {
				$(".main_menu").removeClass("stickMenu");
				$(".crutch").hide();
				$(".icon img").css("display","inline-block");
				$(".main_menu li").removeClass("annulli");
				$(".main_menu li:first-child").removeClass("annul");
				$(".main_menu li:first-child").css("float","left");
				$(".main_menu li").css("display","inline");
				$(".main_menu li").css("float","left");
				
		
			}
			
			
		
		}
		
		
		
		
		
		
		
	});
	
});

*/