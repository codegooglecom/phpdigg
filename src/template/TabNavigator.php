<?php
	$tab = $_GET["tab"] ? $_GET["tab"] : "digg";
	
	if ($tab != "time" && $tab != "digg") {
		$tab = "time";
	}
	
	$timeClass = $tab == "time" ? " selected" : "";
	$diggClass = $tab == "digg" ? " selected" : "";
?>

<ul class="g-tab-panel-nav">
	<li class="g-tab-panel-button<?php echo $timeClass; ?>">
		<a href="default.php?tab=time">Newest</a>
	</li>
	<li class="g-tab-panel-button<?php echo $diggClass; ?>">
		<a href="default.php?tab=digg">Most digged</a>
	</li>
</ul>
