<?php
$previousPage = $page - 1;
if ($previousPage > 0) {
?>
	<a href="default.php?page=<?php echo $page - 1; ?>">Previous</a>
<?php
} else {
?>
	<a class="deactive">Previous</a>
<?php
}

$itemPerPage = 10;
for ($i = 0; $i < $itemCount; $i += $itemPerPage) {
	$p = $i / $itemPerPage + 1;
	echo "<a href='default.php?page=" . $p . "&tab=" . $tab . "' class='" . ($p == $page ? "current" : "") . "'>" . $p . "</a>";
}

if ($i > $page * $itemPerPage) {
?>
<a href="default.php?page=<?php echo $page + 1; ?>">Next</a>
<?php
} else {
?>
<a class="deactive">Next</a>
<?php
}
?>