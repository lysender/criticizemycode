<?php if ( ! empty($error_message)): ?>
	<div class="alert-message fade in error">
		<a href="javascript:void(0)" class="close">x</a>
		<p>
			<strong>ERROR!</strong>
			<?php echo $error_message ?>
		</p>
	</div>
<?php endif ?>

<?php if ( ! empty($success_message)): ?>
	<div class="alert-message fade in success">
		<a href="javascript:void(0)" class="close">x</a>
		<p>
			<strong>SUCCESS!</strong>
			<?php echo $success_message ?>
		</p>
	</div>
<?php endif ?>

<?php if ( ! empty($warning_message)): ?>
	<div class="alert-message fade in warning">
		<a href="javascript:void(0)" class="close">x</a>
		<p>
			<strong>WARNING!</strong>
			<?php echo $warning_message ?>
		</p>
	</div>
<?php endif ?>