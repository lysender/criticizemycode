<?php
	$nav = array(
		'index' => array(
			'controller' => 'index',
			'title' => 'What\'s New?',
			'tooltip' => 'Latest stuff',
			'class' => NULL,
			'link' => '/',
		),
		'post' => array(
			'controller' => 'post',
			'title' => 'post code',
			'tooltip' => 'Let it be criticized',
			'class' => NULL,
			'link' => '/post',
		),
		'browse' => array(
			'directory' => 'browse',
			'controller' => 'browse',
			'title' => 'browse',
			'tooltip' => 'See wicked codes',
			'class' => NULL,
			'link' => '/browse',
		),
	);
	
	$key = $current_controller;
	$dir = $current_directory;
	
	if ( ! empty($dir))
	{
		$key = $dir;
	}
	
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