<?php echo $message ?>

<h2>Updates</h2>

<p>(2011-10-16)</p>

<ul>
	<li>Fixes title being not unique</li>
	<li>Fixes redirection when previous page is a 404 page and user logs in or signs up</li>
	<li>Added commenting system (add only)</li>
	<li>Added unit tests for helper classes, the extended Date and Text class</li>
</ul>

<p>(2011-09-20)</p>

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