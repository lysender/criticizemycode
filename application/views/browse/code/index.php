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

<div id="md-content-<?php echo strtolower($code->language->name) ?>" class="md-content">
	<?php echo $marked_up_content ?>
</div>

<div id="vote-block">
	<a href="#" class="button positive">+1 (200)</a>
	<a href="#" class="button negative">-1 (4.5k)</a>
	<span class="clear">&nbsp;</span>
</div>

<div id="post-comments">
	<h3>Comments</h3>
	<p>There are 4 comments for this code post.</p>
	
	<p>
		<strong>copongcopong</strong> <a href="#">last Monday</a><br />
		Your code sucks big time, mine sucks too.
	</p>
	
	<p>
		<strong>copongcopong</strong> <a href="#">last Monday</a><br />
		Your code sucks big time, mine sucks too.
	</p>
	
	<p>
		<strong>copongcopong</strong> <a href="#">last Monday</a><br />
		Your code sucks big time, mine sucks too.
	</p>
	
	<p>
		<strong>copongcopong</strong> <a href="#">last Monday</a><br />
		Your code sucks big time, mine sucks too.
	</p>
	
	<p>
		<strong>copongcopong</strong> <a href="#">last Monday</a><br />
		Your code sucks big time, mine sucks too.
	</p>
	
	<form id="comment-form" action="/comment" method="post">
		<p>
			Comment:<br />
			<textarea cols="70" rows="10"></textarea>
		</p>
		<p><input type="submit" name="submit" id="comment-submit" value="Post comment" /></p>
	</form>
</div>