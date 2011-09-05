<h1><strong>Login</strong></h1>

<div id="form-wrapper">
	<?php if ( ! empty($error_message)): ?>
	<p class=error><?php echo $error_message ?></p>
	<?php endif ?>
	<form action="<?php echo URL::site('/login') ?>" method="post" enctype="multipart/form-data">
		<div class="span-2"><label for="email">Email</label></div>
		<div class="span-13"><input type="text" name="email" id="email" value="<?php echo $login['email'] ?>" /></div>
		
		<div class="span-2"><label for="password">Password</label></div>
		<div class="span-13"><input type="password" name="password" id="password" value="<?php echo $login['password'] ?>" /></div>

		<div class="span-2">&nbsp;</div>
		<div class="span-13"><label><input type="checkbox" name="remember" id="remember" value="1" <?php echo (!empty($login['remember']) ? 'checked="checked" ' : '') ?> /> Remember me</label></div>
		
		<div class="span-2">&nbsp; <input type="hidden" name="csrf" id="csrf" /></div>
		<div class="span-13"><?php echo Form::submit('submit', 'Login') ?></div>
	</form>
</div>