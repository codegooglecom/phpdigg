<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Twitter 'n Digg</title>
<link rel="stylesheet" type="text/css" href="css/index.css" />
<script type="text/javascript" src="js/json2.js"></script>

<script type="text/javascript" src="js/jquery-1.2.1.js"></script>
<script type="text/javascript" src="js/jquery.ui-1.0/jquery.dimensions.js"></script>
<script type="text/javascript" src="js/jquery.ui-1.0/ui.mouse.js"></script>
<script type="text/javascript" src="js/jquery.ui-1.0/ui.draggable.js"></script>
<script type="text/javascript" src="js/jquery.ui-1.0/ui.draggable.ext.js"></script>
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
		<div class="db"></div>
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
				<button id="commit">Commit</button>
			</div>
		</div>
		
		<div id="timeline" class="timeline">
			<div class="bd">
				<ul>
					<?php foreach($index_digg_item as $digg_item) { ?>
					<li>
						<a class="avator" href="#">
							<img src="images/user.jpg"></img>
						</a>
						<a class="author" href="#">bbiao</a>						
						<span class="op">
							<p id="p<?php echo $digg_item["id"]; ?>"><?php echo $digg_item["count"]; ?></p>
							<button id="<?php echo $digg_item["id"]; ?>" class="digg">Digg</button>
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
				<button>Next</button>
			</div>
		</div>
	</div>
</div>

</body>
</html>