$(document).ready(function () {
    $('a').click(function(){

	var idproduit=$(this).attr("id");
	var nomproduit=$(this).parent().siblings('h5').text();
	var categorie=$(this).parent().siblings('.categorie').text();
	var quantite=$(this).parent().siblings('.quantite').text();
	var prixunitaire=$(this).parent().siblings('.prixunitaire').text();
	var image=$(this).parent().siblings('.image').text();
	var description=$(this).parent().siblings('.description').text();
	$("#idproduitamodifier").attr("value",idproduit);	
	$("#nomproduitamodifier").attr("value",nomproduit);
	$("#categorieamodifier").val(categorie);	
	$("#quantiteamodifier").attr("value",quantite);
	$("#prixunitaireamodifier").attr("value",prixunitaire);	
	//$("#imageamodifier").attr("value",image);
	$("#descriptionamodifier").val(description);		
    });
});
