<div id="banner" class="banner">
	<div id="logo">
		<?php echo img('images/logo.png'); ?>
	</div>
	<div id="navigator">
		<ul>
			<li>
				<?php echo anchor('', '首页'); ?>
			</li>			
			<?php
				$userId = get_cookie('userId');
				
				if ($userId) {
			?>
				<li>
					<?php echo anchor('user/profile', '设置'); ?>
				</li>
				<li>
					<?php echo anchor('user/logout', '注销'); ?>
				</li>				
			<?php		
				} else {
			?>		
				<li>
					<?php echo anchor('user/login', '登录'); ?>
				</li>
				<li>
					<?php echo anchor('user/register', '注册'); ?>
				</li>
			<?php		
				}			
			?>
		</ul>
	</div>
</div>