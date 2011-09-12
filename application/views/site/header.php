<div class="container">
	<div id="head-top">
		<h1>
			<?php echo HTML::anchor('/', 'Criticize My Code') ?>
			<span class="caps thin">Online code review and criticism</span>
		</h1>
		
		<p id="user-bar">
			<?php if (isset($current_user)): ?>
				<span id="username-span"><?php echo HTML::anchor('/user/'.$current_user, $current_user) ?></span>
				<?php echo HTML::anchor('/login/logout/'.$csrf_token, '(Logout)') ?>
			<?php else: ?>
				<span id="username-span">Guest</span>
				<?php echo HTML::anchor('/login', 'Sign-in'),
					' | ',
					HTML::anchor('/signup', 'Signup') ?>
			<?php endif ?>
		</p>
	</div>
</div>

<div id="head-nav">
	<div class="container">
		<div id="search-bar">
			<form id="search-form" method="post" action="<?php echo URL::site('/presearch') ?>">
				<input type="text" name="search_keyword" id="search_keyword" />
				<input type="submit" name="submit" id="search_submit" value="Search" />
				<input type="hidden" name="csrf" class="csrf-field" />
			</form>
		</div>
		<ul>
			<?php foreach ($head_nav as $index => $nav): ?>
				<li<?php echo $nav['class'] ?>>
					<a href="<?php echo URL::site($nav['link']) ?>">
						<?php echo $nav['tooltip'] ?>
						<strong><?php echo $nav['title'] ?></strong>
					</a>
				</li>
			<?php endforeach ?>
		</ul>
	</div>
</div>
