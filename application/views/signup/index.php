<h1>Join the critics and be criticized</h1>

<div id="form-wrapper">
	<?php if ( ! empty($error_message)): ?>
	<p class=error><?php echo $error_message ?></p>
	<?php endif ?>
	<form action="<?php echo URL::site('/signup') ?>" method="post" enctype="multipart/form-data">
		<div class="span-4"><label for="username">Username</label></div>
		<div class="span-11"><input type="text" name="username" id="username" value="<?php echo $signup['username'] ?>" /></div>

		<div class="span-4"><label for="email">Email</label></div>
		<div class="span-11"><input type="text" name="email" id="email" value="<?php echo $signup['email'] ?>" /></div>

		<div class="span-4"><label for="password">Password</label></div>
		<div class="span-11"><input type="password" name="password" id="password" /></div>
		
		<div class="span-4"><label for="password_confirm">Password confirm</label></div>
		<div class="span-11"><input type="password" name="password_confirm" id="password_confirm" /></div>
		
		<div class="span-4">&nbsp; <input type="hidden" name="csrf" id="csrf" class="csrf-field" /></div>
		<div class="span-11"><input type="submit" name="submit" id="submit" value="Sign up" /></div>
	</form>
</div>