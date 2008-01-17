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
		<span>Welcome</span>
	</div>
	<div class="bd">
		<span id="avator-wrapper" class="avator-wrapper">
			<img src="<?php echo $user->getAvatorUrl(); ?>" class="avator"></img>
		</span>
		<span>
			<?php echo $username; ?>
		</span>
		<span>
			<a href="user.php?logout">Logout</a>
		</span>
	</div>
</div>

<?php
} else {
?>

<div id="login" class="g-panel">
	<div class="hd">
		<span>Login</span>
	</div>
	<div class="bd">
		<form id="login-form" action="user.php?login" method="post">
			<div class="form-field">
				<label for="username">Username:</label>
				<input id="username" name="username" type="text" class="text"></input>
			</div>
					
					
			<div class="form-field">
				<label for="password">Password:</label>
				<input id="password" name="password" type="password" class="password"></input>
			</div>
					
			<div class="form-field">
				<input id="autologin" type="checkbox" value="on"></input>
				<label for="autologin">Rember me</label>
			</div>
					
			<div class="form-field">
				<input id="login-form-submit" type="submit" value="Login" class="button"></input>
			</div>
		</form>
	</div>
</div>
		
<div id="register" class="g-panel">
	<div class="hd">
		<span>Not register?</span>
	</div>
	<div class="bd">
		<button id="register-button" class="red">Register</button>
		<form id="register-form" action="user.php?register" method="post">
			<div class="form-field">
				<label for="username">Username:</label>
				<input name="username" type="text" class="text"></input>
			</div>
					
					
			<div class="form-field">
				<label for="password">Password:</label>
				<input name="password" type="password" class="password"></input>
			</div>
					
			<div class="form-field">
				<label for="retype-password">Retype Password:</label>
				<input name="retype-password" type="password" class="password"></input>
			</div>
					
			<div class="form-field">
				<label for="email">Email:</label>
				<input name="email" type="text" class="text"></input>
			</div>
					
			<div class="form-field">
				<input type="submit" value="Register" class="button"></input>
			</div>
		</form>
	</div>
</div>

<?php
}
?>
