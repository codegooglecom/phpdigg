<?php
	include_once "template/CheckAuthentication.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Twitter 'n Digg</title>
<link rel="stylesheet" type="text/css" href="css/g-panel.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/default.css" />
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
			include_once "template/Links.html";
		?>
		
		<?php
			include_once "template/Advertisments.html";
		?>
		
	</div>
	
	<div id="content" class="content">
		<div class="wrapper">
			<div id="user-setting-panel" class="g-panel">
				<div class="hd">User Settings</div>
				<div class="bd">
					<div id="avator-preview" class="avator-preview">
						<img id="avator-preview-img" src="images/user_default_large.gif"></img>
						<div id="info" class="info">
							<?php include_once "template/GetLoginUserInfo.php"; ?>
							<span>Username: <?php echo $user->getUsername(); ?></span>
							<span>Email: <?php echo $user->getEmail(); ?></span>
							<span>Joined: <?php echo $user->getGmtCreate(); ?></span>
						</div>
					</div>
				
					<form id="avator-form" class="avator-form" enctype="multipart/form-data" action="user.php?avator" method="post">
						<div class="form-field">
							<input id="avator" name="avator" type="file"></input>
						</div>
						
						<div class="form-field">
							<input type="submit" value="Upload" class="button"></inpu>
						</div>
					</form>
				</div>			
			</div>
		</div>
	
	</div>
	
	<div class="clear"></div>
</div>

<?php
	include_once "template/Footer.html";
?>
</body>
</html>