<?php
$username = $_COOKIE["userName"];

if ($username != null) {
	header("Location: default.php");
}
?>