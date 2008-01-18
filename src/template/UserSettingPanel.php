<ul id="user-setting-panel-nav" class="g-tab-panel-nav">
  	<li class="g-tab-panel-button selected">
  		<a href="#avator-form-panel">Avator</a>
	</li>
	<li class="g-tab-panel-button">
		<a href="#basic-info-panel">Basic Info</a>
	</li>
	<li class="g-tab-panel-button">
		<a href="#detail-info-panel">Detail Info</a>
	</li>
	<li class="g-tab-panel-button">
		<a href="#im-bind-panel">IM Bind</a>
	</li>
</ul>
<div class="g-tab-panel-content">
	<div id="avator-form-panel" class="g-tab-content">
		<div id="avator-preview" class="avator-preview">
			<?php include_once "template/GetLoginUserInfo.php"; ?>
			<img id="avator-preview-img" src="<?php echo $user->getAvatorUrl(); ?>"></img>
		</div>

		<form id="avator-form" class="avator-form" enctype="multipart/form-data" action="user.php?avator" method="post">
			<div class="form-field">
				<input id="avator" name="avator" type="file"></input>
				<p>Select your avator image(.gif, .jpeg, .jpg, .bmp, .png)</p>
			</div>
						
			<div class="form-field">
				<input id="avator-form-submit" type="submit" value="Upload" class="button"></inpu>
			</div>
		</form>
	</div>	
	
	<div id="basic-info-panel" class="g-tab-content">
		<div id="info" class="info">
			<span>Username: <?php echo $user->getUsername(); ?></span>
			<span>Email: <?php echo $user->getEmail(); ?></span>
			<span>Joined: <?php echo $user->getGmtCreate(); ?></span>
		</div>
	</div>
	
	<div id="detail-info-panel" class="g-tab-content">
		
	</div>
	
	<div id="im-bind-panel" class="g-tab-content">
		
	</div>
</div>