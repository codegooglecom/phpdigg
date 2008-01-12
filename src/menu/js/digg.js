function new_digg_item() {
	var desc = $("#desc").val();
	var price = $("#price").val();
	
	if (desc != null && desc.length > 0 && price != null && price.length > 0) {
		$.ajax({
   			type: "POST",
   			url: "digg-item.php?new",
   			data: {
   				desc: desc,
   				price: price
   			},
   			success: new_digg_item_callback
 		});
	}
}

function new_digg_item_callback(json) {
	var record = JSON.parse(json);
	
	var tr = $(
		"<tr>" + "" +
			"<td><img src='http://photocdn.sohu.com/20080108/Img254529954.jpg'></img></td>" +
			"<td class='desc'>" + record.desc + "</td>" + 
			"<td>" + record.price + "</td>" +
			"<td>" +
				"<button id='" + record.id + "' class='digg-btn'>" + record.count + "</button>" +
			"</td>" +
		"</tr>"
	);
	
//	$("#digg-board tbody").append(tr);
	$("#digg-board tbody").prepend(tr);
	
	$("#" + record.id).click(digg_digg_item);
	
	$("#desc").val("");
	$("#price").val("");
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
		$("#" + record.id).html(record.count);	
	} else {
		alert("Please don't digg twice!");
	}
}

$(function() {
	$("button#add-btn").click(new_digg_item);
	$("button.digg-btn").click(digg_digg_item);
});