$(function() {
	$(".g-panel").hide();
	
	$(".btn.add").click(function() {
		$(".g-panel").fadeIn();
	});
	
	$(".btn.digg").click(digg_digg_item);
	
	$(".g-panel").draggable({
		cursor: "move"
	});
	
	$(".update").click(new_digg_item);
});

function new_digg_item() {
//	var desc = $("#desc").val();
//	var price = $("#price").val();
	
	var update = $(".g-panel textarea").val();
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
 		
 		$(".g-panel").hide();
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
				"<span>" +
					record.update +
				"</span>" +
				"<span class='stamp'>" +
					"01/12/2008" +
				"</span>" +
				"<span class='op'>" +
					"<button id='" + record.id + "' class='btn digg'>0</button>" +
					"<button id='" + record.id + "' class='btn share'>Share</button>" +
				"</span>" +
			"</li>"
	);
	
//	$("#digg-board tbody").append(tr);
	$(".digg-board .bd ul").prepend(li);
	
	$("#" + record.id).click(digg_digg_item);
	
	$(".g-panel textarea").val("");
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
		$("#" + record.id).html(record.count);	
	} else {
		alert("Please don't digg twice!");
	}
}