<!-- Basic scripts -->
<?php foreach ($scripts as $script): ?>
	<?php echo HTML::script($script.'?v='.APP_VERSION), "\n" ?>
<?php endforeach ?>

<script type="text/javascript">
	(function($){
		<?php
			if ( ! empty($head_scripts))
			{
				echo $head_scripts."\n";
			}
		?>

		$(function(){
			<?php
				if ( ! empty($head_readyscripts))
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
			
			// Alerts
			$(".alert-message").alert();
		});
	})(jQuery);
</script>