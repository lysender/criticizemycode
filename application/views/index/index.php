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

<h2>Updates</h2>

<p>(2011-09-20) Last week, we have added the following features:</p>

<ul>
	<li>Whitelisted HTML tags via HTMLPurifier</li>
	<li>Added more languages supported</li>
	<li>Syntaxhilighter for the new languages with new theme</li>
	<li>You can now edit post</li>
</ul>

<p>Please be patient for the very slow development cycle. We only have
a couple of developers who can contribute a couple of hours in weekends.</p>

<p>For issues, feature requests or contribution to the project, visit the
project in Github. Use the branch <code>0.1.0/develop</code>.

<p><a href="https://github.com/lysender/criticizemycode">CriticizeMyCode.com on github</a></p>

<h2>Latest wicked codes</h2>

<?php echo Request::factory('/widgets/latestcode/index')->execute()->body() ?>