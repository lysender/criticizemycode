<div id="foot_nav">
	<ul>
		<li><?php echo HTML::anchor('/admin', 'Dashboard') ?></li>
		<li><?php echo HTML::anchor('/admin/posts', 'Posts') ?></li>
		<li><?php echo HTML::anchor('/admin/comments', 'Comments') ?></li>
		<li><?php echo HTML::anchor('/admin/users', 'Users') ?></li>
		<li><?php echo HTML::anchor('/credits', 'Credits') ?></li>
		<li><?php echo HTML::anchor('/contact', 'Contact') ?></li>
	</ul>
	<p><?php echo HTML::anchor('/', 'Criticize My Code') ?></p>
</div>

<?php if (Kohana::$environment == Kohana::DEVELOPMENT && Kohana::$profiling): ?>
<!-- Profiler stats -->
<div id="kohana-profiler">
	<?php echo View::factory('profiler/stats') ?>
</div>
<?php endif ?>
