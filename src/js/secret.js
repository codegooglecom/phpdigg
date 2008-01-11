$(function() {	
	$("button.digg").click(digg_digg_item);	
	$("button#commit").click(new_digg_item);
});

function new_digg_item() {	
	var update = $(".update textarea").val();
	if (update != null && update.length > 0) {
		$.ajax({
   			type: "POST",
   			url: "secret-item.php?new",
   			data: {
   				name: "",
   				update: update
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
					"<img src='images/user.jpg'></img>" +
				"</a>" + 
				"<a href='#' class='author'>bbiao</a>" + 
				"<span class='op'>" +
					"<p id='p" + record.id + "'>" + record.count + "</p>" +
					"<button id='" + record.id + "' class='btn digg'>Digg</button>" +
				"</span>" +
				"<span>" +
					record.update +
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
   		url: "secret-item.php?digg",
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