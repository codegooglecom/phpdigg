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
		<form id="basic-info-form" action="user.php?password" method="post">
			<h3>帐户信息</h3>
			<div class="form-field">
				<label>用户名</label>
				<input type="text" class="text readonly" readonly="readonly" value="<?php echo $user->getUsername(); ?>" />
			</div>
			<div class="form-field">
				<label>电子邮件</label>
				<input type="text" class="text readonly" readonly="readonly" value="<?php echo $user->getEmail(); ?>" />
			</div>
			<div class="form-field">
				<label>加入时间</label>
				<input type="text" class="text readonly" readonly="readonly" value="<?php echo $user->getGmtCreate(); ?>" />
			</div>
				
			<h3>修改密码</h3>
			<div class="form-field">
				<label>旧密码</label>
				<input id="original-pwd" name="original-pwd" type="password" class="text" value="" />
			</div>
			<div class="form-field">
				<label>新密码</label>
				<input id="new-pwd" name="new-pwd" type="password" class="password" value="" />
			</div>
			<div class="form-field">
				<label>确认新密码</label>
				<input id="retype-pwd" name="retype-pwd" type="password" class="password" value="" />
			</div>
				
			<div class="form-field action">
				<input id="basic-info-form-submit" type="submit" value="保存" class="button"></input>
			</div>
		</form>
	</div>
	
	<div id="detail-info-panel" class="g-tab-content">
		<form id="detail-info-form" action="user.php?profile" method="post">
			<div class="form-field">
				<label for="gender">性别</label>
				<select name="gender" id="gender">
					<?php
						for($idx = 0; $idx < 3; $idx++) {
							if ($idx == $userProfile['gender']) {
								echo '<option value="' . $idx . '" selected="selected">' . UserProfile::$GENDER[$idx] . '</option>';
							} else {
								echo '<option value="' . $idx . '">' . UserProfile::$GENDER[$idx] . '</option>';
							}
						}
					?>
				</select>
			</div>
			<div class="form-field">
				<label for="birth-year">生日</label>
				<input name="birth-year" type="text" class="text tiny" value="<?php echo $userProfile['birthYear']; ?>" maxlength="4" />
				年
				<select name="birth-month" id="birth-month">
					<?php
						for($idx = 1; $idx < 12; $idx++) {
							if ($idx == $userProfile['birthMonth']) {
								echo '<option value="' . $idx . '" selected="selected">' . $idx . '</option>';
							} else {
								echo '<option value="' . $idx . '">' . $idx . '</option>';
							}
						}
					?>
				</select>
				月
				<select name="birth-day" id="birth-day">
					<?php
						for($idx = 1; $idx < 31; $idx++) {
							if ($idx == $userProfile['birthDay']) {
								echo '<option value="' . $idx . '" selected="selected">' . $idx . '</option>';
							} else {
								echo '<option value="' . $idx . '">' . $idx . '</option>';
							}
						}
					?>
				</select>
				日
			</div>
			<div class="form-field">
				<label for="province">所在地</label>
				<select name="province" id="province">
					<?php
						for($idx = 0; $idx < 35; $idx++) {
							if ($idx == $userProfile['province']) {
								echo '<option value="' . $idx . '" selected="selected">' . UserProfile::$PROVINCE[$idx] . '</option>';
							} else {
								echo '<option value="' . $idx . '">' . UserProfile::$PROVINCE[$idx] . '</option>';
							}
						}
					?>
				</select>
				<!-- <select name="city" id="city"> -->
				<input type="text" value="<?php echo $userProfile['city']; ?>" name="city" class="text tiny"></input>
			</div>
	
			<div class="form-field">
				<label for="homeprovince">家乡</label>
				<select name="home-province" id="home-province">
					<?php
						for($idx = 0; $idx < 35; $idx++) {
							if ($idx == $userProfile['homeProvince']) {
								echo '<option value="' . $idx . '" selected="selected">' . UserProfile::$PROVINCE[$idx] . '</option>';
							} else {
								echo '<option value="' . $idx . '">' . UserProfile::$PROVINCE[$idx] . '</option>';
							}
						}
					?>
				</select>
				<!-- <select name="home-city" id="home-city"> -->
				<input type="text" value="<?php echo $userProfile['homeCity']; ?>" name="home-city" class="text tiny"></input>
			</div>
			<div class="form-field">
				<label for="homepage">个人网址</label>
				<input name="homepage" type="text" class="text large" id="homepage" value="<?php echo $userProfile['homepage']; ?>" />
			</div>
			<div class="form-field">
				<label for="comment">自述</label>
				<textarea name="comment" id="comment" rows="6" cols="50"><?php echo $userProfile['comment']; ?></textarea>
			</div>
			<div class="form-field action">
				<input id="detail-info-form-submit" type="submit" value="保存" class="button"></input>
			</div>
		</form>
	</div>
	
	<div id="im-bind-panel" class="g-tab-content">
		<form id="im-bind-form" action="user.php?bindFF" method="post">				
			<h3>绑定饭否帐号</h3>
			<div class="form-field">
				<label>用户名</label>
				<input name="username" type="text" class="text" value="<?php echo $accountBinding['username']; ?>" />
			</div>
			<div class="form-field">
				<label>密码</label>
				<input name="password" type="password" class="password" value="<?php echo base64_decode($accountBinding['password']); ?>" />
			</div>				
			<div class="form-field action">
				<input id="im-bind-form-submit" type="submit" value="绑定" class="button"></input>
			</div>
		</form>
	</div>
</div>