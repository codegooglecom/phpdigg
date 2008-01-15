<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Twitter 'n Digg</title>
<link rel="stylesheet" type="text/css" href="css/g-panel.css" />
<link rel="stylesheet" type="text/css" href="css/index.css" />
<script type="text/javascript" src="js/json2.js"></script>

<script type="text/javascript" src="js/jquery-1.2.1.js"></script>
<script type="text/javascript" src="js/digg.js"></script>
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
<div id="banner" class="banner">
	<h2>Twigg</h2>
	<span>Twitter 'n Digg - Place you can express yourself and listen to others</span>
</div>
<div id="board" class="board">
	<div id="sidebar" class="sidebar">
		<div id="faq">
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
		<div id="update" class="update">
			<div class="hd">
				My one secret...
			</div>
			<div class="bd">
				<form>
					<textarea id="secret" name="secret" rows="4" cols="40"></textarea>
				</form>
			</div>
			<div class="ft">
				<span id="share" class="share-tool">
					<input id="share-to-fanfou" name="share-to-fanfou" type="checkbox"></input>
					<label for="share-to-fanfou">Public to <a href="http://www.fanfou.com">fanfou.com</a></label>
					
					<span id="username-n-password" style="display: none;">
						<label for="fanfou-username">Username:</label>
						<input id="fanfou-username" name="fanfou-username" type="text" class="tiny"></input>
						
						<label for="fanfou-password">Password:</label>
						<input id="fanfou-password" name="fanfou-password" type="password" class="tiny"></input>
					</span>
				</span>
				<span>
					<button id="commit">Commit</button>
				</span>
			</div>
		</div>
		
		<div id="timeline" class="timeline">
			<?php include_once "template/TabNavigator.php"; ?>
		
			<?php include_once "template/DataTable.php"; ?>
			<div class="bd">
				<ul>
					<?php foreach($index_digg_item as $digg_item) { ?>
					<li>
						<a class="avator" href="#">
							<img src="images/0.gif"></img>
						</a>
						<a class="author" href="#">
							<?php echo $digg_item["userName"]; ?>
						</a>						
						<span class="op">
							<p id="p<?php echo $digg_item["id"]; ?>"><?php echo $digg_item["recommend"]; ?></p>
							<button id="<?php echo $digg_item["id"]; ?>" class="digg">Digg</button>
						</span>
						<span class="content">
							<?php echo $digg_item["content"]; ?>
						</span>
						<span class="stamp">
							<?php echo $digg_item["gmtCreate"]; ?>
						</span>
					</li>
					<?php } ?>
				</ul>
			</div>
			
			<div class="ft">
				<?php include_once "template/Pagination.php"; ?>
			</div>
		</div>
	</div>
</div>

<?php
	include_once "template/Footer.html";
?>
</body>
</html>