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
</p>

<div id="md-content">
	<?php echo $marked_up_content ?>
</div>