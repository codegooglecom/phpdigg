<div id="login" class="g-panel">
<div class="hd">注册新用户</div>
<div class="bd">
<?php echo form_open('user/create'); ?>
	<div class="form-field">
		<label for="username">用户名</label>
		<input name="username" type="text" class="text large"></input>
		<span class="hint">用来登录小秘密，最少 2 个汉字或 4 个字符，最多 6 个汉字或 12 个字符</span>
	</div>
					
	<div class="form-field">
		<label for="password">密码</label>
		<input name="password" type="password" class="password large"></input>
		<span class="hint">最少 6 个字符</span>
	</div>
					
	<div class="form-field">
		<label for="retype-password">重新输入密码</label>
		<input name="retype-password" type="password" class="password large"></input>
		<span class="hint"></span>
	</div>
					
	<div class="form-field">
		<label for="email">电子邮件</label>
		<input name="email" type="text" class="text large"></input>
		<span class="hint">我们不会对外公开你的邮件地址</span>
	</div>
					
	<div class="form-field">
		<input type="submit" value="注册" class="button"></input>
	</div>
<?php echo form_close(); ?>
</div>
</div>