<div id="head-top" class="container">
	<h1>
		<?php echo HTML::anchor('/', 'Criticize My Code') ?>
		<span class="caps thin">Online code review and criticism</span>
	</h1>
	
	<p id="user-bar">
		<?php if (isset($current_user)): ?>
			<span id="username-span"><?php echo HTML::anchor('/user/'.$current_user, $current_user) ?></span>
			<?php echo HTML::anchor('/login/logout', '(Logout)', array('id' => 'h-logout-link')) ?>
			<form id="logout-form" method="post" action="<?php echo URL::site('/login/logout') ?>">
				<input type="hidden" name="csrf" class="csrf-field" />
			</form>
		<?php else: ?>
			<span id="username-span">Guest</span>
			<?php echo HTML::anchor('/login', 'Sign-in'),
				' | ',
				HTML::anchor('/signup', 'Signup') ?>
		<?php endif ?>
	</p>
</div>

<div id="head-nav">
	<div class="container">
		<div id="search-bar">
			<form id="search-form" method="post" action="<?php echo URL::site('/presearch') ?>">
				<input type="text" name="search_keyword" id="search_keyword" />
				<input type="submit" name="submit" id="search_submit" value="Search" class="btn primary" />
				<input type="hidden" name="csrf" class="csrf-field" />
			</form>
		</div>
		<?php echo $nav ?>
	</div>
</div>
