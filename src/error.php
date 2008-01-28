<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Twigg - 分享你的秘密</title>
<link rel="stylesheet" type="text/css" href="css/g-panel.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/default.css" />
<link rel="stylesheet" type="text/css" href="css/ad.css" />
<link rel="stylesheet" type="text/css" href="css/user-setting.css" />

<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/jquery-1.2.2.js"></script>
<script type="text/javascript" src="js/user-setting.js"></script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-566045-2");
pageTracker._initData();
pageTracker._trackPageview();
</script>

</head>
<body>
<?php include_once "template/Banner.php"; ?>

<div id="board" class="box-blue board">
	<div id="sidebar" class="sidebar">
		<div id="faq" class="g-panel">
			<div class="hd">
				<span>
					小秘密是什么？
				</span>
			</div>
			<div class="bd">
				<span>
					 这是一个小秘密的发布站点，你可以在这里匿名发布你的小秘密，大家一起来分享，一起来顶！！
				</span>
			</div>
		</div>
		
		<?php
			include_once "template/Authentication.php";
		?>
		
		<?php
			include_once "template/Links.html";
		?>
		
		<?php
			include_once "template/Advertisments.html";
		?>
		
	</div>
	
	<div id="content" class="content">
		<div class="wrapper"><div id="user-setting-panel" class="g-panel">
			<div class="hd">出错啦</div>
			<div class="bd">
				<?php echo $flash['error']; ?>
			</div>			
		</div></div>
	
	</div>
	
	<div class="clear"></div>
</div>

<?php
	include_once "template/Footer.html";
?>
</body>
</html>