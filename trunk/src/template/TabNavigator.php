<?php
	$tab = $_GET["tab"] ? $_GET["tab"] : "time";
	
	if ($tab != "time" && $tab != "digg") {
		$tab = "time";
	}
	
	$timeClass = $tab == "time" ? " selected" : "";
	$diggClass = $tab == "digg" ? " selected" : "";
?>

<ul class="g-tab-panel-nav">
	<li class="g-tab-panel-button<?php echo $timeClass; ?>">
		<a href="<?php echo $baseUrl; ?>?tab=time">最新</a>
	</li>
	<li class="g-tab-panel-button<?php echo $diggClass; ?>">
		<a href="<?php echo $baseUrl; ?>?tab=digg">最热门</a>
	</li>
</ul>
