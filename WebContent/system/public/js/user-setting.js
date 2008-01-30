$(function() {
	$("#avator").change(change_avator_img);
	$("#avator-form-submit").click(function() {
		var imgUrl = $("#avator").val();
		var imgExtPos = imgUrl.lastIndexOf(".");
		var imgExt = imgUrl.substr(imgExtPos + 1);
		
		if(checkImg(imgExt)) {
			return true;
		} else {
			alert("File type not supported!");
			return false;
		}
		
	});
	
	$(".g-tab-content").hide();
	var activeTab = $("#avator-form-panel").show();
	var activeTabButton = $("#user-setting-panel-nav .g-tab-panel-button.selected");
	
	
	$(".g-tab-panel-button a").click(function() {
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
	
	$('#basic-info-form-submit').click(change_password);
});

var allowImgExt = ["jpg", "jpeg", "bmp", "gif", "png"];

function checkImg(ext) {
	for (var i = 0, l = allowImgExt.length; i < l; i++) {
		if (allowImgExt[i] == ext.toLowerCase())
			return true;
	}
	
	return false;
}

function change_avator_img() {
	var imgUrl = $("#avator").val();
	var imgExtPos = imgUrl.lastIndexOf(".");
	var imgExt = imgUrl.substr(imgExtPos + 1);
	
	if(checkImg(imgExt)) {
		$("#avator-preview-img").attr("src", imgUrl);
	} else {
		//$("#avator").val("");
	}
}

function is_blank(str) {
	return str == null || str.length == 0;
}

function change_password() {
	var url = $("#basic-info-form").attr("action") + "&json";
	var method = $("#basic-info-form").attr("method") || 'POST';
		
		
	var oldPwd = $('#original-pwd').val();
	var newPwd = $('#new-pwd').val();
	var retype = $('#retype-pwd').val();
	
	if (is_blank(oldPwd) || is_blank(newPwd) || is_blank(retype) ) {
		alert('Please enter all three field!');
		return false;
	}
	
	if (newPwd != retype) {
		alert('Password retype dismatch the new password');
		$('#retype-pwd').val('');
		return false;
	}
	
//	$.ajax({
//   		type: method,
//   		url: url,
//   		data: {
//   			'original-pwd': oldPwd,
//   			'new-pwd': newPwd
//   		},
//   		success: change_password_callback
// 	});
//	return false;

	return true;
}

function change_password_callback(data) {
	result = JSON.parse(data);
	
	if (result.success) {
		alert('Success');
	} else {
		alert('Failed');
	}
}