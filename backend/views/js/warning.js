$(function(){
$(".cube-switch4 .switch4").click(function(){
	    if ($(".cube-switch4").hasClass("active4")){
	        $(".cube-switch4").removeClass("active4");
	        $("#warningled").addClass("led-red");
	        $("#warningled").removeClass("led-green");
	    } else{
	        $(".cube-switch4").addClass("active4");
	        $("#warningled").removeClass("led-red");
	        $("#warningled").addClass("led-green");
	    }
	});
});