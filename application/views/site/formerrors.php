<?php if (isset($error_message) && ! empty($error_message)): ?>
	<div class="alert-message block-message fade in error">
		<a class="close" href="javascript:void(0)">x</a>
		<p><strong>ERROR!</strong> Form was not submitted due to the following error(s):</p>
		<ul>
			<?php
				$block_errors = explode('<br />', $error_message);
			?>
			<?php foreach ($block_errors as $error): ?>
			<li><?php echo HTML::chars($error) ?></li>
			<?php endforeach ?>
		</ul>
	</div>
<?php endif ?>