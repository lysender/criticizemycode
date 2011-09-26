<h1><?php echo HTML::chars($code->title) ?></h1>

<?php if ( ! empty($error_message)): ?>
<p class="error"><?php echo $error_message ?></p>
<?php endif ?>

<?php if ( ! empty($success_message)): ?>
<p class="success"><?php echo $success_message ?></p>
<?php endif ?>

<p id="code-meta">
	Posted <a href="<?php echo $code->get_view_url() ?>"><?php echo Date::extra_fuzzy_span($code->date_posted) ?></a>
	by <a href="<?php echo $code->user->get_profile_url() ?>"><?php echo $code->user->username ?></a>
	<?php if ($user_can_edit): ?>
		<a href="<?php echo $code->get_edit_url() ?>"> - edit</a>
	<?php endif ?>
</p>

<div id="md-content-<?php echo strtolower($code->language->name) ?>" class="md-content">
	<?php echo $marked_up_content ?>
</div>

<div id="post-comments clearfix">
	<h3>Comments</h3>
	<?php
		echo Request::factory('widgets/comment/'.$code->id)
			->execute()
			->body();
	?>
	<?php if (isset($current_user) && $current_user): ?>
		<?php echo $comment_form ?>
	<?php else: ?>
		<p>To comment, <a href="/login"><strong>sign-in</strong></a> or <a href="/signup"><strong>sign-up</strong></a>.</p>
	<?php endif ?>
</div>