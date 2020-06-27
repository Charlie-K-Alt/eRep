var btnIns = ["#blocIns"];

$(document).ready(function(){
	/**
	 * Permet de cacher le button inscription
	 */
	moncac (["#btnInsc"], "");

	$("#menumatiere").click(function(){
		$.getJSON("http://127.0.0.1:8001/api/matieres", function( data ) {
			var items = [];
			$.each(data, function (key, tab) {
				items.push("<li id='" + key + "'>" + tab['codmat']+ ":" + tab['libelle'] + "</li>");
				//console.log(key + "->" + tab['codmat']+ ":" + tab['libelle']);
			});

			$("<ul/>", {
				"class": "my-new-list",
				html: items.join("")
			}).appendTo("body");
		});
		//console.log(sendAjaxRequest("POST", "http://127.0.0.1:8001/api/matieres", '', 'application/json'));
	});
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

function sendAjaxRequest(method, url, data, contentType) {
    var response;
    $.ajax({
        method: method,
        url: url,
        data: data,
        dataType: 'json',
        contentType: contentType,
        success: function(msg) {
            response = msg;
        }
    });
    return response;
    //return jQuery.parseJSON(response);
}