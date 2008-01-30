<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Twigg - <?php echo $title; ?></title>
<?php echo css('css/common.css', 'css/g-panel.css', 'css/base.css', 'css/user.css'); ?>
</head>
<body>
<div class="body">
	<?php $this->load->view('templates/banner'); ?>
	
	<div class="content">		
		<div class="board">		
			<?php $this->load->view($essential); ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php $this->load->view('templates/footer'); ?>
</div>
</body>
</html>