<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>digg</title>
<link rel="stylesheet" type="text/css" href="css/secret.css" />
<script type="text/javascript" src="js/jquery-1.2.1.js"></script>
<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/jquery.ui-1.0/jquery.dimensions.js"></script>
<script type="text/javascript" src="js/jquery.ui-1.0/ui.mouse.js"></script>
<script type="text/javascript" src="js/jquery.ui-1.0/ui.draggable.js"></script>
<script type="text/javascript" src="js/jquery.ui-1.0/ui.draggable.ext.js"></script>
<script type="text/javascript" src="js/gpanel.js"></script>
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
<?php
require_once "secret-item.php";
$index_digg_item = index_digg_item();
?>
<div class="g-panel">
	<div class="hd">gPanel Template</div>
	<div class="bd">
		<textarea rows="12" cols="40"></textarea>
		<button class="update btn">Update</button>
	</div>
	<div class="ft">FOOT</div>
</div>

<div class="digg-board">
	<div class="hd">
		<ul>
			<li><button class="btn add">添加</button></li>
			<li><button class="btn">排行</button></li>
			<li><button class="btn">最新</button></li>
			<li><button class="btn">注册</button></li>
			<li class="clear"></li>
		</ul>
	</div>
	
	<div class="bd">
		<div class="stream">
		<ul>
			<?php foreach($index_digg_item as $digg_item) { ?>
			<li>
				<a href="#" class="avator">
					<img src="images/user.jpg"></img>
				</a>
				<a href="#" class="author">bbiao</a>
				<span>
					<?php echo $digg_item["content"]; ?>
				</span>
				<span class="stamp">
					01/12/2007
				</span>
				<span class="op">
					<button id="<?php echo $digg_item["id"]; ?>" class="btn digg"><?php echo $digg_item["count"]; ?></button>
					<button id="<?php echo $digg_item["id"]; ?>" class="btn share">Share</button>
				</span>
			</li>
			<?php } ?>
		</ul>
		</div>
	</div>

</div>

</body>
</html>