<title><?php echo ( ! empty($title)) ? $title.' :: ' : '' ?>Criticize My Code</title>
<meta charset="utf-8">

<?php if (isset($description) && $description): ?>
<meta name="description" content="<?php echo $description ?>">
<?php endif ?>
	
<?php if (isset($keywords) && $keywords): ?>
<meta name="keywords" content="<?php echo $keywords ?>">
<?php endif ?>

<link rel="shortcut icon" href="/favicon.ico?v=<?php echo APP_VERSION ?>">

<!-- Basic styles -->
<?php
	echo HTML::style('media/css/bootstrap.min.css?v='.APP_VERSION)."\n",
		HTML::style('media/css/style.css?v='.APP_VERSION)."\n",
		HTML::style('media/css/crud.css?v='.APP_VERSION)."\n";
?>
<?php foreach ($styles as $style): ?>
	<?php echo HTML::style($style.'?v='.APP_VERSION)."\n" ?>
<?php endforeach ?>
	
<?php if (Kohana::$environment == Kohana::DEVELOPMENT && Kohana::$profiling): ?>
<!-- Profiler Styles -->
<style type="text/css">
	<?php include Kohana::find_file('views', 'profiler/style', 'css') ?>
</style>
<?php endif ?>
