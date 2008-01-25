<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Twigg - 分享你的秘密</title>
<link rel="stylesheet" type="text/css" href="css/g-panel.css" />
<link rel="stylesheet" type="text/css" href="css/ad.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/default.css" />
<script type="text/javascript" src="js/json2.js"></script>

<script type="text/javascript" src="js/jquery-1.2.2.js"></script>
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
<?php include_once "template/Banner.html"; ?>

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
			include_once "template/RecentLoginUser.php";
		?>
		
		<?php
			include_once "template/FeedSubscribe.html";
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
				我的小秘密...
			</div>
			<div class="bd">
				<form id="message-form" action="digg-item.php?create" method="post">
					<div class="form-field">
						<textarea id="secret" name="secret" rows="4" cols="40"></textarea>
					</div>
									
					<div class="form-field">
						<input id="share-to-fanfou" name="share-to-fanfou" type="checkbox"></input>
						<label for="share-to-fanfou">同时发布到 <a href="http://www.fanfou.com">fanfou.com</a></label>
					</div>
								
					<div id="username-n-password" style="display: none;" class="bd">
						<div class="form-field">
							<label for="fanfou-username">用户名:</label>
							<input id="fanfou-username" name="fanfou-username" type="text" class="text"></input>
						</div>
										
						<div class="form-field">
							<label for="fanfou-password">密码:</label>
							<input id="fanfou-password" name="fanfou-password" type="password" class="text"></input>
						</div>
					</div>
									
					<div class="form-field center">
						<input id="commit" type="submit" value="贴一下" class="button"></input>
					</div>
				</form>
				
				<div id="message-form-tip" class="g-tip large">
				</div>
			</div>
			<div class="ft">
				
			</div>
		</div>
		
		<div id="timeline" class="timeline">
			<?php 
				$baseUrl = $_SERVER["PHP_SELF"];
				include_once "template/TabNavigator.php";
			?>
		
			<?php include_once "template/DataTable.php"; ?>
			<div class="bd">
				<ul>
					<?php foreach($index_digg_item as $digg_item) { ?>
					<li>
						<a class="avator" href="#">
							<img src="<?php echo $digg_item["userAvator"]; ?>"></img>
						</a>
						<a class="author" href="#">
							<?php echo $digg_item["userName"]; ?>
						</a>						
						<span class="op">
							<span id="p<?php echo $digg_item["id"]; ?>"><?php echo $digg_item["recommend"]; ?></span>
							<button id="<?php echo $digg_item["id"]; ?>" class="digg">
							<?php
								$id = $digg_item["id"];
								$digg = $_COOKIE[$id];

								if (!$digg) {
									echo "顶一下";
								} else {
									echo "顶过了";
								}
							?>
							</button>
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