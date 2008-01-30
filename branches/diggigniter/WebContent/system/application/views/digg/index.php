<div id="board" class="board">
	<?php $this->load->view('digg/add'); ?>
	<div id="timeline" class="timeline">
		<ul>
		<?php foreach($query->result_array() as $digg_item) { ?>
			<li>
				<a class="avator" href="<?php echo 'index.php/user/show/' . $digg_item["user_name"]; ?>">
					<?php echo img($digg_item["avator_url"]); ?>
				</a>
				<a class="author" href="<?php echo 'index.php/user/show/' . $digg_item["user_name"]; ?>">
					<?php echo $digg_item["user_name"]; ?>
				</a>						
				<span class="op">
					<span id="p<?php echo $digg_item["id"]; ?>"><?php echo $digg_item["recommend"]; ?></span>
					<button id="<?php echo $digg_item["id"]; ?>" class="digg">
					<?php
						$id = $digg_item["id"];
						$digg = NULL;//= $_COOKIE[$id];

						if (!$digg) {
							echo "顶一下";
						} else {
							echo "顶过了";
						}
					?>
					</button>
				</span>
				<span class="digg-content">
					<?php echo $digg_item["content"]; ?>
				</span>
				<span class="stamp">
					<?php echo $digg_item["gmt_create"]; ?>
				</span>
			</li>
		<?php } ?>
		</ul>
	</div>
</div>