<h1><strong>Add</strong> Item</h1>

<p><a class="menu-back" href="<?php echo URL::site('/inventory/stock/index/'.$selected_category.'/'.$current_page) ?>">Back to items</a></p>

<div id="form-wrapper" class="span-14 last">
	<?php if (isset($error_message) && $error_message): ?>
	<p class=error><?php echo $error_message ?></p>
	<?php endif ?>
	<form action="<?php echo URL::site('/inventory/item/add/'.$selected_category.'/'.$current_page) ?>" method="post" enctype="multipart/form-data">
		<div class="span-3"><?php echo $item->label('category') ?></div>
		<div class="span-10 last"><?php echo $item->input('category') ?></div>
			
		<div class="span-3"><?php echo $item->label('name') ?></div>
		<div class="span-10 last"><?php echo $item->input('name') ?></div>
		
		<div class="span-3"><?php echo $item->label('description') ?></div>
		<div class="span-10 last"><?php echo $item->input('description') ?></div>
		
		<div class="span-3">&nbsp;<?php echo Form::hidden('csrf', Security::token(TRUE)) ?></div>
		<div class="span-10 last"><input type="submit" id="submit" name="submit" value="Add" /></div>
	</form>
</div>