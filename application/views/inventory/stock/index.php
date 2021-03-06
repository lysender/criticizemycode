<h1><strong>Stock</strong> List</h1>

<p><a class="menu-back" href="<?php echo URL::site('/inventory') ?>">Back to Inventory</a></p>

<?php if (isset($error_message) && $error_message): ?>
<p class="error"><?php echo $error_message ?></p>
<?php endif ?>

<?php if (isset($success_message) && $success_message): ?>
<p class="success"><?php echo $success_message ?></p>
<?php endif ?>

<div class="span-20">
<?php if (isset($paginator) && $paginator): ?>
	<?php echo $paginator ?>
<?php endif ?>&nbsp;
</div>

<div class="span-4 last">&nbsp;</div>

<div class="reglist-w">
	<table class="reg-list">
		<thead>
			<tr>
				<th>&nbsp;</th>
				<th>Category</th>
				<th>Name</th>
				<th>Description</th>
				<th>Qty</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		<?php if (isset($items) && $items): ?>
		<?php foreach ($items as $key => $row): ?>
			<tr>
				<td class="crud-edit"><a href="<?php echo URL::site('/inventory/item/edit/'.$row['id']) ?>">Edit</a></td>
				<td><?php echo HTML::chars($row['category_name']) ?></td>
				<td><?php echo HTML::chars($row['name']) ?></td>
				<td><?php echo HTML::chars($row['description']) ?> &nbsp;</td>
				<td><?php echo HTML::chars($row['quantity']) ?> &nbsp;</td>
				<td class="crud-delete"><a href="<?php echo URL::site('/inventory/item/delete/'.$row['id']) ?>">Delete</a></td>
			</tr>
		<?php endforeach ?>
		<?php endif ?>
		</tbody>
	</table>
</div>
<?php echo View::factory('site/predelete') ?>