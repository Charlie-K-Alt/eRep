var btnIns = ["#blocIns"];

$(document).ready(function(){
	/**
	 * Permet de cacher le button inscription
	 */
	moncac (["#btnInsc"], "");
	/**
	 * Cacher le button inscription au niveau de parent
	 */
	$("#itemtabPar").click(function(){
		moncac (["#btnInsc"], "");
	});

	$("#itemtabApp").click(function(){
		moncac ([""], "#btnInsc");
	});
	/**
	 * Recuperer les informations de login et de password (navbar)
	 */
	$("#btnCnx").click(function(){
		var log = $("#cnxlog").val(),
			pass = $("#cnxpass").val();

		alert(log+" - "+pass);
	});
	/**
	 * Recuperer les informations de Parent et de Apprenant
	 */
	$("#btnInsc").click(function () {
		var nompa = $("#nompar").val(),
			prenompa = $("#prenompar").val(),
			telpa = $("#telpar").val(),
			emailpa = $("#emailpar").val(),
			nomap = $("#nomapp").val(),
			prenomap = $("#prenomapp").val(),
			emailap = $("#emailapp").val(),
			pass = $("#passapp").val(),
			mot = $("#motapp").val(),
			date = $("#datapp").val(),
			sexe1 = $("#sexem").val(),
			sexe2 = $("#sexef").val();

		alert(nompa+"-"+prenomap+"-"+telpa+"-"+pass+"-"+sexe1);
	});

});