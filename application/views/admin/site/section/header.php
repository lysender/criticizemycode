<div id="head-top" class="container">
	<h1>
		<?php echo HTML::anchor('/', 'Criticize My Code') ?>
		<span class="caps thin">System Administration Section</span>
	</h1>
	
	<p id="user-bar">
		<?php if (isset($current_user)): ?>
			<span id="username-span"><?php echo HTML::anchor('/user/'.$current_user, $current_user) ?> (admin)</span>
			<?php echo HTML::anchor('/login/logout', '(Logout)', array('id' => 'h-logout-link')) ?>
			<form id="logout-form" method="post" action="<?php echo URL::site('/login/logout') ?>">
				<input type="hidden" name="csrf" class="csrf-field" />
			</form>
		<?php endif ?>
	</p>
</div>

<div id="head-nav">
	<div class="container"><?php echo $nav ?></div>
</div>
