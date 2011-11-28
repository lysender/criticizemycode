<h1>Create account</h1>

<p>Please enter your <strong>username</strong> and <strong>email</strong>. When you login next time, we will not be asking any username and password.
<a href="/signup">For regular signup procedure, click here</a>.</p>

<div id="form-wrapper">
	<?php echo $message ?>

	<form action="/openconnect/twitter/signup" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="clearfix">
				<label for="username">Username</label>
				<div class="input">
					<input class="xlarge" type="text" name="username" id="username" value="<?php echo $signup['username'] ?>" />
				</div>
			</div>
	
			<div class="clearfix">
				<label for="email">Email</label>
				<div class="input">
					<input class="xlarge" type="text" name="email" id="email" value="<?php echo $signup['email'] ?>" />
				</div>
			</div>
			
			<div class="clearfix">
				<div class="input">
					<input class="btn primary" type="submit" name="submit" id="submit" value="Sign me up" />
					<input type="hidden" name="csrf" id="csrf" class="csrf-field" />
				</div>
			</div>
		</fieldset>
	</form>
</div>