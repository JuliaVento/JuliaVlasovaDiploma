 $(document).ready(function(){
		
    $(".enter").click(function(){
        $("#form_enter").show(1000);
		$("#form_reg").hide(1000);
    });
    $(".registrate").click(function(){
        $("#form_enter").hide(1000);
		$("#form_reg").show(1000);
    });
});