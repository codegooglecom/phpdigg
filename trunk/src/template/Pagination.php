<?php
$previousPage = $page - 1;

$itemPerPage = 10;

$i = (int) (($page - 1) / 5) * 5 + 1;

$end = $i + 5;
$totalPage = (int) (($itemCount - 1) / $itemPerPage) + 1;

if ($end > $totalPage) {
	$end = $totalPage;
}

if ($i > 5) {
?>
	<a href="default.php?page=<?php echo $i - 5; ?>">前5页</a>
<?php
}

if ($previousPage > 0) {
?>
	<a href="default.php?page=<?php echo $page - 1; ?>">前1页</a>
<?php
} else {
?>
	<!-- <a class="deactive">Previous</a> -->
<?php
}

for (; $i <= $end; $i++) {
	$p = $i;
	echo "<a href='" . $baseUrl . "?page=" . $p . "&tab=" . $tab . "' class='" . ($p == $page ? "current" : "") . "'>" . $p . "</a>";
}

if ($i < $totalPage + 1) {
?>
<a href="default.php?page=<?php echo $page + 1; ?>">后1页</a>
<a href="default.php?page=<?php echo $i; ?>">后5页</a>
<?php
} else {
?>
	<!-- a class="deactive">Next</a> -->
<?php
}
?>
<a><?php echo "$page/$totalPage"; ?></a>