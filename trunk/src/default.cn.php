<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Twitter 'n Digg</title>
<link rel="stylesheet" type="text/css" href="css/index.css" />
<script type="text/javascript" src="js/json2.js"></script>

<script type="text/javascript" src="js/jquery-1.2.1.js"></script>
<script type="text/javascript" src="js/secret.js"></script>
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

<div id="board" class="board">
	<div id="sidebar" class="sidebar">
		<div class="hd"></div>
		<div class="db">
			<p>
				 这是一个小秘密的发布站点，你可以在这里匿名发布你的小秘密，大家一起来分享，一起来顶！！
			</p>
		</div>
	</div>	
	
	<div id="content" class="content">
		<div id="update" class="update">
			<div class="hd">
				我的小秘密...
			</div>
			<div class="bd">
				<form>
					<textarea id="secret" name="secret" rows="4" cols="40"></textarea>
				</form>
			</div>
			<div class="ft">
				<button id="commit">提交</button>
			</div>
		</div>
		
		<div id="timeline" class="timeline">
			<div class="bd">
				<ul>
					<?php foreach($index_digg_item as $digg_item) { ?>
					<li>
						<a class="avator" href="#">
							<img src="images/0.gif"></img>
						</a>
						<a class="author" href="#">One</a>						
						<span class="op">
							<p id="p<?php echo $digg_item["id"]; ?>"><?php echo $digg_item["count"]; ?></p>
							<button id="<?php echo $digg_item["id"]; ?>" class="digg">顶一下</button>
						</span>
						<span class="content">
							<?php echo $digg_item["content"]; ?>
						</span>
						<span class="stamp">
							01/12/2008
						</span>
					</li>
					<?php } ?>
				</ul>
			</div>
			
			<div class="ft">
				<button>下一页</button>
			</div>
		</div>
	</div>
</div>

</body>
</html>