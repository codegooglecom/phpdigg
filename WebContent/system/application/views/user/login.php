<div id="login" class="g-panel">
<div class="hd">用户登录</div>
<div class="bd">
<?php echo form_open('user/login'); ?>
	<div class="form-field">
		<label for="username">用户名</label>
		<input id="username" name="username" type="text" class="text"></input>
		<span class="hint">注册小秘密时你输入的用户名</span>
	</div>
					
					
	<div class="form-field">
		<label for="password">密码</label>
		<input id="password" name="password" type="password" class="password"></input>
		<span class="hint">你的密码</span>
	</div>
			
	<!--	
	<div class="form-field">
		<input id="autologin" type="checkbox" value="on"></input>
		<label for="autologin">记住我</label>
	</div>
	-->
					
	<div class="form-field">
		<input id="login-form-submit" type="submit" value="登录" class="button"></input>
		<?php echo anchor('user/register', '现在注册', array('class' => 'red-button')); ?>
	</div>
<?php echo form_close(); ?>
</div>
</div>
