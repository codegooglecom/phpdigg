$(function() {	
	$("button.digg").click(digg_digg_item);	
	$("button#commit").click(new_digg_item);
	
	$("#share-to-fanfou").removeAttr("checked").click (function() {
		if ($(this).attr("checked")) {
			$("#username-n-password").css("display", "");
		} else {
			$("#username-n-password").css("display", "none");
		}
	});
});

function new_digg_item() {	
	var update = $(".update textarea").val();
	
	var ffUsername = null;
	var ffPassword = null;
	
	var shareToFanfou = false;
	
	if ($("#share-to-fanfou").attr("checked")) {
		ffUsername = $("#fanfou-username").val();
		ffPassword = $("#fanfou-password").val();
		
		if (ffUsername != null && ffUsername.length > 0 && ffPassword != null && ffPassword.length > 0) {
			shareToFanfou = "true";
		}
	}
	
	if (update != null && update.length > 0) {
		$.ajax({
   			type: "POST",
   			url: "digg-item.php?new",
   			data: {
   				name: "",
   				content: update,
   				shareToFanfou: shareToFanfou,
   				ffUsername: ffUsername,
   				ffPassword: ffPassword
   			},
   			success: new_digg_item_callback
 		});
	}
}

function new_digg_item_callback(json) {
	var record = JSON.parse(json);
	
	var li = $(
		"<li>" + 
				"<a href='#' class='avator'>" +
					"<img src='images/0.gif'></img>" +
				"</a>" + 
				"<a href='#' class='author'>One</a>" + 
				"<span class='op'>" +
					"<p id='p" + record.id + "'>" + record.recommend + "</p>" +
					"<button id='" + record.id + "' class='btn digg'>Digg</button>" +
				"</span>" +
				"<span>" +
					record.content +
				"</span>" +
				"<span class='stamp'>" +
					"01/12/2008" +
				"</span>" +
			"</li>"
	);
	
	$(".board .bd ul").prepend(li);
	
	$("#" + record.id).click(digg_digg_item);
	
	$(".update textarea").val("");
}

function digg_digg_item() {
	var id = $(this).attr("id");
	$.ajax({
   		type: "POST",
   		url: "digg-item.php?digg",
   		data: {
   			id: id
   		},
   		success: digg_digg_item_callback
 	});
}

function digg_digg_item_callback(json) {
	var record = JSON.parse(json);
	
	if (record.digg) {
		$("#p" + record.id).html(record.count);	
	} else {
		alert("Please don't digg twice!");
	}
}