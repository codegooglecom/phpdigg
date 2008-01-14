<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Twitter 'n Digg</title>
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
<?php
require_once "digg-item.php";
$page = $_GET["page"] ? $_GET["page"] : 1;
$itemCount = $action->itemCount();
$index_digg_item =$action->indexDiggItem($page, 10);
?>
<div id="head" class="head">
	<h2>我的秘密!</h2>
</div>
<div id="board" class="board">
	<div id="sidebar" class="sidebar">
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
		
		<div class="bd" style="margin-top: 5px;">
			<script type="text/JavaScript"> 
				alimama_pid="mm_10730599_774820_1567895"; 
				alimama_titlecolor="0000FF"; 
				alimama_descolor ="000000"; 
				alimama_bgcolor="FFFFFF"; 
				alimama_bordercolor="C5D7EF"; 
				alimama_linkcolor="008000"; 
				alimama_bottomcolor="FFFFFF"; 
				alimama_anglesize="6"; 
				alimama_bgpic="0"; 
				alimama_icon="0"; 
				alimama_sizecode="22"; 
				alimama_width=120; 
				alimama_height=240; 
				alimama_type=2; 
			</script> 
			<script src="http://a.alimama.cn/inf.js" type=text/javascript> 
			</script>
		</div>
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
					<label for="share-to-fanfou">同时发布到 <a href="http://www.fanfou.com">fanfou.com</a></label>
					<input id="share-to-fanfou" name="share-to-fanfou" type="checkbox"></input>
					
					<span id="username-n-password" style="display: none;">
						<label for="fanfou-username">用户名:</label>
						<input id="fanfou-username" name="fanfou-username" type="text" class="tiny"></input>
						
						<label for="fanfou-password">密码:</label>
						<input id="fanfou-password" name="fanfou-password" type="password" class="tiny"></input>
					</span>
				</span>
				<span>
					<button id="commit">提交</button>
				</span>
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
						<a class="author" href="#">
							<?php echo $digg_item["userName"]; ?>
						</a>						
						<span class="op">
							<p id="p<?php echo $digg_item["id"]; ?>"><?php echo $digg_item["recommend"]; ?></p>
							<button id="<?php echo $digg_item["id"]; ?>" class="digg">投票</button>
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
</body>
</html>