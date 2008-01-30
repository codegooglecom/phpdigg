<div id="login" class="g-panel">
	<div class="hd">Twigg 用户</div>
	<div class="bd">
		<div class="user">
			<span id="avator">
				<?php echo img($user['avator_url'], array('id' => 'avator-img')); ?>
			</span>
			<span>
				<?php echo $user['username']; ?>
			</span>
		</div>
		<div class="profile">
			<?php if(isset($profile)) { ?>
				<span>来自 <?php echo UserProfile::$PROVINCE[$profile['province']] . ' ' . $profile['city']; ?></span>
				<span>主页 <?php echo $profile['homepage'];?></span>
				<span>介绍 <?php echo $profile['comment'];?></span>
			<?php } ?>
		</div>
	</div>
</div>