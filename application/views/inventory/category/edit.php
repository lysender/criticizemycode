<h1><strong>Edit</strong> Item Category</h1>

<p><a class="menu-back" href="<?php echo URL::site('/inventory/category') ?>">Back to categories</a></p>

<div id="form-wrapper" class="span-14 last">
	<?php if (isset($error_message) && $error_message): ?>
	<p class=error><?php echo $error_message ?></p>
	<?php endif ?>
	<form action="<?php echo URL::site('/inventory/category/edit/'.$category->id) ?>" method="post" enctype="multipart/form-data">
		<div class="span-3"><?php echo $category->label('name') ?></div>
		<div class="span-10 last"><?php echo $category->input('name') ?></div>
		
		<div class="span-3"><?php echo $category->label('description') ?></div>
		<div class="span-10 last"><?php echo $category->input('description') ?></div>
		
		<div class="span-3">&nbsp;<?php echo Form::hidden('csrf', Security::token(TRUE)) ?></div>
		<div class="span-10 last"><input type="submit" id="submit" name="submit" value="Update" /></div>
	</form>
</div>