$(document).ready(function () {
    $('a').click(function(){
	var idproduit=$(this).attr("id");
	var nomproduit=$(this).parent().siblings('h5').text();
	$("#produitadelete").text(nomproduit);
	$("#produitadelete2").attr("value",nomproduit);
	$("#idadelete").attr("value",idproduit);	
    });
});
