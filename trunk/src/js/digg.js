$(function() {	
	$("button.digg").click(digg_digg_item);	
	$("#commit").click(new_digg_item);
	
	$("#share-to-fanfou").removeAttr("checked").click (function() {
		if ($(this).attr("checked")) {
			$("#username-n-password").fadeIn();
		} else {
			$("#username-n-password").fadeOut();
		}
	});
	
	$("#register-form").hide();
	$("#register-button").click(function() {
		$(this).hide();	
		$("#register-form").fadeIn();
	});
	
	var activeTab = $("#message-form");
	var activeTabButton = $("#post-panel .g-tab-panel-button.selected");
	
	$("#post-panel .g-tab-panel-button a").click(function() {
		var pos = this.href.search(/#/);
		var id = this.href.substr(pos);
		
		if (activeTab != null) {
			activeTab.hide();
		}
		
		if (activeTabButton != null) {
			activeTabButton.removeClass("selected");
		}
		
		activeTab = $(id).show();
		activeTabButton = $(this).parent().addClass("selected");

		return false;
	});
	
	$("#login-form-submit").click(ajax_login);
});

function ajax_login() {
	var password = $("#password").val();
	var username = $("#username").val();
	
	if (username.length == 0) {
		alert("Please enter your username.");
		return false;
	}
		
	if (password.length == 0) {
		alert("Please enter your password.");
		return false;
	}
		
	$("#login-form").hide();	
	$("#login-form-tip").show();
	var url = $("#login-form").attr("action") + "&json";
	var method = $("#login-form").attr("method");
		
	$.ajax({
   		type: method,
   		url: url,
   		data: {
   			username: username,
   			password: password
   		},
   		success: ajax_login_callback
 	});
	return false;
}

function ajax_login_callback(data) {
	var result = JSON.parse(data);
	
	if (result.result) {
		$("#login-form").submit();
	} else {
		alert("Username or password wrong!");
		$("#login-form-tip").hide();
		$("#login-form").show();	
	}
}

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
		$("#message-form").hide();
		$("#message-form-tip").show();
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
	
	return false;
}

function new_digg_item_callback(json) {
	var record = JSON.parse(json);
	
	var li = $(
		"<li>" + 
				"<a href='#' class='avator'>" +
					"<img src='" + record.avator + "'></img>" +
				"</a>" + 
				"<a href='#' class='author'>" + record.userName + "</a>" + 
				"<span class='op'>" +
					"<span id='p" + record.id + "'>" + record.recommend + "</span>" +
					"<button id='" + record.id + "' class='btn digg'>Digg</button>" +
				"</span>" +
				"<span>" +
					record.content +
				"</span>" +
				"<span class='stamp'>" +
					record.gmtCreate +
				"</span>" +
			"</li>"
	);
	
	$("#timeline .bd ul").prepend(li);
	li.hide().fadeIn();
	
	$("#" + record.id).click(digg_digg_item);
	
	$(".update textarea").val("");
	
	$("#share-to-fanfou").removeAttr("checked");
	$("#username-n-password").css("display", "none");
	
	$("#message-form").show();
	$("#message-form-tip").hide();
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