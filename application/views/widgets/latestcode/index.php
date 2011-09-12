<?php if ( !empty($codes)): ?>
	<ul id="code-post-list">
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