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
		$userId = get_cookie('userId');
		
		if ($userId) {
			$this->load->view('user/show');
		} else {
			$this->load->view('user/login');
		}
		
		$this->load->view('templates/recent');
	?>
</div>