$(function() {
	$("#avator").change(change_avator_img);
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
	}	
}