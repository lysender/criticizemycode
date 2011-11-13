<?php
	$nav = array(
		'index' => array(
			'controller' => 'index',
			'title' => 'Dashboard',
			'tooltip' => 'Quick pick actions',
			'class' => NULL,
			'link' => '/admin',
		),
		'posts' => array(
			'controller' => 'posts',
			'title' => 'posts',
			'tooltip' => 'Manage posts',
			'class' => NULL,
			'link' => '/admin/posts',
		),
		'comments' => array(
			'controller' => 'comments',
			'title' => 'comments',
			'tooltip' => 'Manage comments',
			'class' => NULL,
			'link' => '/admin/comments',
		),
		'users' => array(
			'controller' => 'users',
			'title' => 'users',
			'tooltip' => 'Manage users',
			'class' => NULL,
			'link' => '/admin/users'
		),
	);
	
	$key = $current_controller;
	
	if ($key && ! empty($nav[$key]))
	{
		$nav[$key]['class'] = ' class="selected"';
	}
?>
<ul>
	<?php foreach ($nav as $index => $v): ?>
		<li<?php echo $v['class'] ?>>
			<a href="<?php echo URL::site($v['link']) ?>">
				<?php echo $v['tooltip'] ?>
				<strong><?php echo $v['title'] ?></strong>
			</a>
		</li>
	<?php endforeach ?>
</ul>