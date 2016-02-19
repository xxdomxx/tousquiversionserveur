$(document).ready(function(){
	$('input').click(function(){
		var prixtotal=0;
		$('.prixunitaireproduit').each(function(){
			var prixunitaire=$(this).text();
			//alert(prixunitaire);
			var prixunitdouble = Number(prixunitaire.replace(/[^0-9\.]+/g,""));
			var quantite=$(this).siblings('.inputquantiteproduitproduit').children('.quantiteproduitproduit').val();
			//alert(quantite);
			prixtotal+=quantite*prixunitdouble;
		});
		$('#totalpaypal').attr("value",prixtotal);
		prixtotal+='$';
		$('.prixtotaltotal').text(prixtotal);
			
	});
	
});
