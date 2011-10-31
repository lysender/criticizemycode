<div class="hero-unit">
	<h1>Criticize My Code</h1>

	<p><strong>CriticizeMyCode.com</strong> is an online code sharing, reviewing
	and criticizing	site for developer's code, whether it is the best, the worst
	or the most wicked code ever written. We are still on our pre-beta, so feel
	free to play around.</p>

	<p>
	<?php if (isset($current_user) && $current_user): ?>
		<a class="btn primary large" href="<?php echo URL::site('/browse') ?>">Browse codes</a>
	<?php else: ?>
		<a class="btn primary large" href="<?php echo URL::site('/signup') ?>">Join us now</a>
		<a class="btn primary large" href="<?php echo URL::site('/login') ?>">Sign in</a>
	<?php endif ?>
	</p>
</div>