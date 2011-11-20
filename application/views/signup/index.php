<h1>Join the critics and be criticized</h1>

<?php echo $open_connect ?>

<div id="form-wrapper">
	<?php echo $message ?>

	<form action="<?php echo URL::site('/signup') ?>" method="post" enctype="multipart/form-data">
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
				<label for="password">Password</label>
				<div class="input">
					<input class="xlarge" type="password" name="password" id="password" />
				</div>
			</div>
	
			<div class="clearfix">
				<label for="password_confirm">Password confirm</label>
				<div class="input">
					<input class="xlarge" type="password" name="password_confirm" id="password_confirm" />
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