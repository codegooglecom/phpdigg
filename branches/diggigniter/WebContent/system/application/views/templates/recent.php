<div id="login" class="g-panel">
	<div class="hd">最近登录的用户</div>
	<div class="bd">
	<?php foreach ($recent as $user) { ?>
		<div class="user">
			<span class="avator">
				<?php echo img($user['avator_url'], array('id' => 'avator-img')); ?>
			</span>
			<span>
				<?php echo $user['username']; ?>
			</span>
		</div>
	<?php } ?>
	</div>
</div>