<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $head ?>
</head>

<body>
<header><?php echo $header ?></header>

<div id="content">
	<div class="container">
		<div class="row">
			<div id="main-content" class="span16">
				<?php echo $content ?>
			</div>
		</div>
	</div>
</div>

<footer class="footer">
	<div class="container"><?php echo $footer ?></div>
</footer>

<?php echo $javascript ?>
</body>
</html>