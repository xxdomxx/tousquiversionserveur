$(document).ready(function () {
   $('#btnpayeravecpaypal').click(function(){
	request = $.ajax({
	    url: "mailconfirmationcommande.php",
	    type: "post"
	});

	request.done(function (response, textStatus, jqXHR){
		$("#form-payer-paypal").submit();
	});

	request.fail(function (jqXHR, textStatus, errorThrown){
	    alert(
		"L'erreur suivante est survenue: "+
		textStatus, errorThrown
	    );
    	});
   });
});
