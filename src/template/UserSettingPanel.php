<ul id="user-setting-panel-nav" class="g-tab-panel-nav">
  	<li class="g-tab-panel-button selected">
  		<a href="#avator-form-panel">头像</a>
	</li>
	<li class="g-tab-panel-button">
		<a href="#basic-info-panel">基本信息</a>
	</li>
	<li class="g-tab-panel-button">
		<a href="#detail-info-panel">详细信息</a>
	</li>
	<li class="g-tab-panel-button">
		<a href="#im-bind-panel">帐户绑定</a>
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
				<p>请选择你的头像的图片文件, 类型(.gif, .jpeg, .jpg, .bmp, .png)</p>
			</div>
						
			<div class="form-field">
				<input id="avator-form-submit" type="submit" value="上传" class="button"></input>
			</div>
		</form>
	</div>	
	
	<div id="basic-info-panel" class="g-tab-content">
		<div id="info" class="info">
			<span>用户名: <?php echo $user->getUsername(); ?></span>
			<span>电子邮件: <?php echo $user->getEmail(); ?></span>
			<span>加入时间: <?php echo $user->getGmtCreate(); ?></span>
		</div>
	</div>
	
	<div id="detail-info-panel" class="g-tab-content">
		
	</div>
	
	<div id="im-bind-panel" class="g-tab-content">
		
	</div>
</div>