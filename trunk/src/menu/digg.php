<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>digg</title>
<link rel="stylesheet" type="text/css" href="css/digg.css" />
<script type="text/javascript" src="../js/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../js/json2.js"></script>
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
$index_digg_item = index_digg_item();
?>
<h2>订餐 Digg beta</h2>

<table id="digg-board" class="digg-board">
	<thead>
		<tr>
			<th>添加</th>
			<th class="desc">
				<input id="desc" type="text" name="desc"></input>
			</th>
			<th class="price">
				<input id="price" type="text" name="price"></input>
			</th>
			<th>
				<button id="add-btn" class="add-btn">Add</button>
			</th>
		</tr>
		<tr>
			<th>图片</th>
			<th class="desc">
				菜名
			</th>
			<th class="price">
				价格
			</th>
			<th>
				Digg!
			</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($index_digg_item as $digg_item) { ?>
		<tr>
			<td><img src="http://photocdn.sohu.com/20080108/Img254529954.jpg"></img></td>
			<td class="desc"><?php echo $digg_item["name"] ; ?></td>
			<td><?php echo $digg_item["price"]; ?></td>
			<td>
				<button id="<?php echo $digg_item["id"]; ?>" class="digg-btn"><?php echo $digg_item["count"]; ?></button>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>

</body>
</html>