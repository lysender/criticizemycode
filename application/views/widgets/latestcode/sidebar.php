<?php if ( !empty($codes)): ?>
	<ul id="latest-codes-sidebar">
	<?php foreach ($codes as $code): ?>
		<li>
			<a href="<?php echo $code->get_view_url() ?>"><?php echo Text::limit_chars(HTML::chars($code->title), 60) ?></a><br />
			<span><?php echo Date::extra_fuzzy_span($code->date_posted) ?></span>
		</li>
	<?php endforeach ?>
	</ul>
<?php endif ?>