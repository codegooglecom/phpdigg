<div id="update" class="update">
<?php echo form_open('digg/create'); ?>
	<div class="form-field">
		<input type="text" name="title"/>
	</div>
	
	<div class="form-field">
		<textarea name="content" rows="4" cols="40"></textarea>
	</div>
	
	<div class="form-field action">
		<input type="submit" value="提交" class="button">
	</div>
<?php echo form_close(); ?>
</div>