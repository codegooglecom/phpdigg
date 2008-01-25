<?php
include_once "include/Prepare.php";

include_once "controller/action/UserAction.php";

$action = new UserAction();

$userList = $action->getRecentLoginUser();
?>
<div id="recent-login-user" class="g-panel">
	<div class="hd">
		<span>最近登录用户</span>
	</div>
	<div class="bd">
	
<?php
foreach($userList as $user) {
?>
	<div>
		<img width="16" height="16" src="<?php echo $user["avator"]; ?>"></img>
		<span><?php echo $user["username"]; ?></span>
	</div>
<?php
}
?>

	</div>
</div>