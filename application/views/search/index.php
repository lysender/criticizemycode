<h1>Search results for <span class="negative">"<?php echo HTML::chars($keyword) ?>"</span></h1>

<?php if ( ! empty($error_message)): ?>
<p class="error"><?php echo $error_message ?></p>
<?php endif ?>

<?php if ( ! empty($success_message)): ?>
<p class="success"><?php echo $success_message ?></p>
<?php endif ?>

<?php if ( !empty($codes)): ?>
	<ul id="search-results">
	<?php foreach ($codes as $code): ?>
		<li>
			<a href="<?php echo $code->get_view_url() ?>"><?php echo HTML::chars($code->title) ?></a>
			<ul>
				<li>
					<?php echo Date::extra_fuzzy_span($code->date_posted) ?>
					by <a href="<?php echo $code->user->get_profile_url() ?>"><?php echo $code->user->username ?></a>
				</li>
			</ul>
		</li>
	<?php endforeach ?>
	</ul>
<?php endif ?>

<?php if ( ! empty($paginator)): ?>
	<div class="span-16"><?php echo $paginator ?></div>
<?php endif ?>