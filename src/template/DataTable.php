<?php
require_once "digg-item.php";
$page = $_GET["page"] ? $_GET["page"] : 1;
$itemCount = $action->itemCount();

$order = $tab == "digg" ? "recommend" : "gmtCreate";

$index_digg_item = $action->indexDiggItem($page, 10, $order);
?>