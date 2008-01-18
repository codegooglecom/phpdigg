<?php
include_once "include/Prepare.php";

include_once "model/bean/DiggItem.php";
include_once "model/dao/DiggItemDao.php";
include_once "model/service/DiggItemManager.php";

$manager = new DiggItemManager();
$sql = "select distinct(user_name) as un from digg_item";
$result = $manager->execute($sql);

echo  "<pre>";

foreach($result as $record) {
	echo $record["un"];
	echo "<br />";
	
	$un = $record["un"];
	
	$sql = "select id from digg_user where username='$un'";
	echo $sql;
	echo "<br />";
	
	$idResult = $manager->execute($sql);
	echo $idResult[0]["id"];
	echo "<br />";
	
	$id = $idResult[0]["id"];
	
	$sql = "update digg_item set user_id=$id where user_name='$un'";
	echo $sql;
	echo "<br />";
	
	$manager->execute($sql);
}

echo "</pre>";

?>