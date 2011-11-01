<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $head ?>
</head>

<body>
<header><?php echo $header ?></header>

<div id="content">
	<div class="container">
		<?php echo $content ?>
		<div class="row">
			<div id="main-content" class="span11">
				<?php echo $updates ?>
			</div>
			<div id="side-bar" class="span5">
				<?php echo $sidebar ?>
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