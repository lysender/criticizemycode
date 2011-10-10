<h1>Login</h1>

<div id="form-wrapper">
	
	<?php echo View::factory('site/messages')
		->bind('error_message', $error_message)
		->bind('success_message', $success_message)
		->bind('warning_message', $warning_message)
	?>
	
	<form action="<?php echo URL::site('/login') ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="clearfix">
				<label for="email">Username / email</label>
				<div class="input">
					<input class="xlarge" type="text" name="email" id="email" value="<?php echo $login['email'] ?>" />
				</div>
			</div>
			
			<div class="clearfix">
				<label for="password">Password</label>
				<div class="input">
					<input class="xlarge" type="password" name="password" id="password" />
				</div>
			</div>
	
			<div class="clearfix">
				<div class="input">
					<ul class="inputs-list">
						<li>
							<label>
								<input type="checkbox" name="remember" id="remember" value="1" <?php echo (!empty($login['remember']) ? 'checked="checked" ' : '') ?> />
								<span>Remember me</span>
							</label>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="clearfix">
				<div class="input">
					<input class="btn primary" type="submit" name="submit" id="submit" value="Login" />
					<input type="hidden" name="csrf" id="csrf" class="csrf-field" />
				</div>
			</div>
		</fieldset>
	</form>
</div>