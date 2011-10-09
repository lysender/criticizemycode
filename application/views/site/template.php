<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo ( ! empty($title)) ? $title.' :: ' : '' ?>Criticize My Code</title>
<meta charset="utf-8">
<meta name="robots" content="all">

<?php if (isset($description) && $description): ?>
<meta name="description" content="<?php echo $description ?>">
<?php endif ?>
	
<?php if (isset($keywords) && $keywords): ?>
<meta name="keywords" content="<?php echo $keywords ?>">
<?php endif ?>

<link rel="shortcut icon" href="/favicon.ico?v=<?php echo APP_VERSION ?>">

<!-- basic styles -->
<?php foreach ($styles as $style => $media)
	echo HTML::style($style.'?v='.APP_VERSION, array('media' => $media)), "\n" ?>
	
<!--[if IE]>
<?php echo HTML::style('media/css/ie.css?v='.APP_VERSION, array('media' => 'screen, projection')) ?>
<![endif]-->

<script type="text/javascript">
	var base_url = '<?php echo URL::site('/') ?>';
</script>
	
<?php if (Kohana::$environment == Kohana::DEVELOPMENT && Kohana::$profiling): ?>
<!-- Profiler Styles -->
<style type="text/css">
	<?php include Kohana::find_file('views', 'profiler/style', 'css') ?>
</style>
<?php endif ?>
</head>

<body>
<header><?php echo $header ?></header>

<div id="content">
	<div class="container">
		<div class="row">
			<div id="main-content" class="span11">
				<?php echo $content ?>
			</div>
			<div id="side-bar" class="span5">
				<?php echo $sidebar ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<footer class="footer">
	<div class="container"><?php echo $footer ?></div>
</footer>

<!-- basic scripts -->
<?php foreach ($scripts as $script)
	echo HTML::script($script.'?v='.APP_VERSION), "\n" ?>

<script type="text/javascript">
	(function($){
		<?php
			if ( !empty($head_scripts))
			{
				echo $head_scripts."\n";
			}
		?>

		$(function(){
			<?php
				if ( !empty($head_readyscripts))
				{
					echo $head_readyscripts."\n";
				}
			
				if ( !empty($csrf_token))
				{
					echo '$(".csrf-field").val("'.$csrf_token.'");'."\n";
				}
			?>
			
			<?php if (isset($current_user) && $current_user): ?>
				$("#h-logout-link").click(function(){
					$("#logout-form").submit();
					return false;
				});
			<?php endif ?>
		});
	})(jQuery);
</script>
</body>
</html>