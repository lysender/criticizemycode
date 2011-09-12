<h1>Welcome! We are in our pre-beta!</h1>

<?php if ( ! empty($error_message)): ?>
<p class="error"><?php echo $error_message ?></p>
<?php endif ?>

<?php if ( ! empty($success_message)): ?>
<p class="success"><?php echo $success_message ?></p>
<?php endif ?>

<p><strong>CriticizeMyCode.com</strong> is an online code sharing, reviewing
and criticizing site for developer's code, whether it is the best, the worst
or the most wicked code ever written.</p>

<p>We are currently on our pre-beta. For the mean time, you can now start signing
up and post your code snippets. Our code commenting system is still in
progress.</p>

<h2>Latest wicked codes</h2>

<?php echo Request::factory('/widgets/latestcode/index')->execute()->body() ?>