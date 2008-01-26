<div id="banner" class="banner">	
	<div class="hd">
		<!-- 
		<h2>Twigg - 小秘密</h2>
		<span>Place you can express yourself and listen to others</span>
		-->
		<div id="logo">
			<img src="images/logo.png"></img>
		</div>
		
		<div id="banner-ad">
			<script type="text/JavaScript"> 
				alimama_pid="mm_10730599_774820_1656604"; 
				alimama_titlecolor="0000FF"; 
				alimama_descolor ="000000"; 
				alimama_bgcolor="FFFFFF"; 
				alimama_bordercolor="C5D7EF"; 
				alimama_linkcolor="008000"; 
				alimama_bottomcolor="FFFFFF"; 
				alimama_anglesize="6"; 
				alimama_bgpic="0"; 
				alimama_icon="0"; 
				alimama_sizecode="12"; 
				alimama_width=468; 
				alimama_height=60; 
				alimama_type=2; 
			</script> 
			<script src="http://a.alimama.cn/inf.js" type=text/javascript> 
			</script>
		</div>
		
		<div class="clear">
		</div>
	</div>
	<div class="bd">
		<ul>
			<li><a href="/">首页</a></li>
			<li><a href="user-setting.php">设置</a></li>
			<?php
				$username = $_COOKIE["userName"];

				if ($username != null) {
			?>
				<li><a href="user.php?logout">注销</a></li>
			<?php } else { ?>
				<li><a href="login.php">登录</a></li>
			<?php } ?>
		</ul>
	</div>
</div>