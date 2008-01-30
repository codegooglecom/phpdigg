<?php echo css('css/g-tab-panel.css', 'css/user-setting.css'); ?>
<?php echo js('js/json2.js', 'js/jquery-1.2.2.js', 'js/user-setting.js'); ?>
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
	<div id="avator-form-panel" class="g-panel g-tab-content">
		<div class="bd">
			<div id="avator-preview" class="avator-preview">
				<?php echo img($user['avator_url'], array('id' => 'avator-preview-img')); ?>
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
	</div>	
	
	<div id="basic-info-panel" class="g-panel g-tab-content">
		<div class="bd">
			<form>
				<h3>帐户信息</h3>
				<div class="form-field">
					<label>用户名</label>
					<input type="text" class="text readonly" readonly="readonly" value="<?php echo $user['username']; ?>" />
				</div>
				<div class="form-field">
					<label>电子邮件</label>
					<input type="text" class="text readonly" readonly="readonly" value="<?php echo $user['email']; ?>" />
				</div>
				<div class="form-field">
					<label>加入时间</label>
					<input type="text" class="text readonly" readonly="readonly" value="<?php echo $user['gmt_create']; ?>" />
				</div>
			</form>
			<?php echo form_open('user/update/password', array( 'id' => 'basic-info-form')); ?>				
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
					<input type="hidden" name="action" value="updatePassword"/>
					<input id="basic-info-form-submit" type="submit" value="保存" class="button"></input>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
	
	<div id="detail-info-panel" class="g-panel g-tab-content">
		<div class="bd">
			<?php echo form_open('user/update/profile', array( 'id' => 'detail-info-form')); ?>
				<div class="form-field">
					<input type="hidden" name="user_id" value="<?php echo $userProfile['user_id']; ?>" />
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
					<input name="birth-year" type="text" class="text tiny" value="<?php echo $userProfile['birth_year']; ?>" maxlength="4" />
					年
					<select name="birth-month" id="birth-month">
						<?php
							for($idx = 1; $idx < 12; $idx++) {
								if ($idx == $userProfile['birth_month']) {
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
								if ($idx == $userProfile['birth_day']) {
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
								if ($idx == $userProfile['home_province']) {
									echo '<option value="' . $idx . '" selected="selected">' . UserProfile::$PROVINCE[$idx] . '</option>';
								} else {
									echo '<option value="' . $idx . '">' . UserProfile::$PROVINCE[$idx] . '</option>';
								}
							}
						?>
					</select>
					<!-- <select name="home-city" id="home-city"> -->
					<input type="text" value="<?php echo $userProfile['home_city']; ?>" name="home-city" class="text tiny"></input>
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
			<?php echo form_close(); ?>
		</div>
	</div>
	
	<div id="im-bind-panel" class="g-panel g-tab-content">
		<div class="bd">
			<?php echo form_open('user/update/bind', array( 'id' => 'tt-bind-form')); ?>				
				<h3>绑定Twitter帐号</h3>
				<div class="form-field">
					<label>用户名</label>
					<input name="username" type="text" class="text" value="<?php echo $accountBinding['tt']['username']; ?>" />
				</div>
				<div class="form-field">
					<label>密码</label>
					<input name="password" type="password" class="password" value="<?php echo base64_decode($accountBinding['tt']['password']); ?>" />
				</div>				
				<div class="form-field action">
					<input type="hidden" name="type" value="tt"/>
					<input id="tt-bind-form-submit" type="submit" value="绑定" class="button"></input>
				</div>
			<?php echo form_close(); ?>
			
			<?php echo form_open('user/update/bind', array( 'id' => 'ff-bind-form')); ?>			
				<h3>绑定饭否帐号</h3>
				<div class="form-field">
					<label>用户名</label>
					<input name="username" type="text" class="text" value="<?php echo $accountBinding['ff']['username']; ?>" />
				</div>
				<div class="form-field">
					<label>密码</label>
					<input name="password" type="password" class="password" value="<?php echo base64_decode($accountBinding['ff']['password']); ?>" />
				</div>				
				<div class="form-field action">
					<input type="hidden" name="type" value="ff"/>
					<input id="ff-bind-form-submit" type="submit" value="绑定" class="button"></input>
				</div>
			<?php echo form_close(); ?>
			
			<?php echo form_open('user/update/bind', array( 'id' => 'jw-bind-form')); ?>				
				<h3>绑定叽歪帐号</h3>
				<div class="form-field">
					<label>用户名</label>
					<input name="username" type="text" class="text" value="<?php echo $accountBinding['jw']['username']; ?>" />
				</div>
				<div class="form-field">
					<label>密码</label>
					<input name="password" type="password" class="password" value="<?php echo base64_decode($accountBinding['jw']['password']); ?>" />
				</div>				
				<div class="form-field action">
					<input type="hidden" name="type" value="jw"/>
					<input id="jw-bind-form-submit" type="submit" value="绑定" class="button"></input>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>