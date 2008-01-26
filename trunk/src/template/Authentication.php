<?php
$username = $_COOKIE["userName"];

if ($username != null) {

include_once "include/Prepare.php";
include_once "controller/action/UserAction.php";

$action = new UserAction();
$user = $action->getLoginUser();

?>

<div id="welcome" class="g-panel">
	<div class="hd">
		<span>欢迎</span>
	</div>
	<div class="bd">
		<span id="avator-wrapper" class="avator-wrapper">
			<img src="<?php echo $user->getAvatorUrl(); ?>" class="user-avator"></img>
		</span>
		<span>
			<?php echo $username; ?>
		</span>
		<span>
			<a href="user.php?logout">退出</a>
		</span>
	</div>
</div>

<?php
} else {
?>

<div id="login" class="g-panel">
	<div class="hd">
		<span>登录</span>
	</div>
	<div class="bd">
		<form id="login-form" action="user.php?login" method="post">
			<div class="form-field">
				<label for="username">用户名:</label>
				<input id="username" name="username" type="text" class="text"></input>
			</div>
					
					
			<div class="form-field">
				<label for="password">密码:</label>
				<input id="password" name="password" type="password" class="password"></input>
			</div>
			
			<!--	
			<div class="form-field">
				<input id="autologin" type="checkbox" value="on"></input>
				<label for="autologin">记住我</label>
			</div>
			-->
					
			<div class="form-field">
				<input id="login-form-submit" type="submit" value="登录" class="button"></input>
			</div>
		</form>
		
		<div id="login-form-tip" class="g-tip">
		</div>
	</div>
</div>
		
<div id="register" class="g-panel">
	<div class="hd">
		<span>没有注册?</span>
	</div>
	<div class="bd">
		<button id="register-button" class="red">现在注册</button>
		<form id="register-form" action="user.php?register" method="post">
			<div class="form-field">
				<label for="username">用户名:</label>
				<input name="username" type="text" class="text"></input>
			</div>
					
					
			<div class="form-field">
				<label for="password">密码:</label>
				<input name="password" type="password" class="password"></input>
			</div>
					
			<div class="form-field">
				<label for="retype-password">重新输入密码:</label>
				<input name="retype-password" type="password" class="password"></input>
			</div>
					
			<div class="form-field">
				<label for="email">电子邮件:</label>
				<input name="email" type="text" class="text"></input>
			</div>
					
			<div class="form-field">
				<input type="submit" value="注册" class="button"></input>
			</div>
		</form>
	</div>
</div>

<?php
}
?>
