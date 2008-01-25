$(function() {	
	$("#register-form").hide();
	$("#register-button").click(function() {
		$(this).hide();	
		$("#register-form").fadeIn();
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
