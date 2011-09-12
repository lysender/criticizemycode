<h1>What is this all about?</h1>

<p><strong>CriticizeMyCode.com</strong> is an online community who showcase the best, worst and
most wicked codes ever written.</p>

<p>It's ultimate goal is to tell what's the best practice, what is wrong
and what should be the right for solving a certain problem.</p>

<p>Fear not to show your code!</p>

<h3>Latest codes</h3>

<?php echo Request::factory('/widgets/latestcode/sidebar')->execute()->body() ?>

<h3>Markdown tips</h3>

<ul>
	<li>Wrap with underscore for emphasized texts</li>
	<li>Wrap with asterisk for bolded texts</li>
	<li>To write codes, indent them with 4 spaces</li>
	<li>Alternatively, you can also wrap them inside ~~~ and ~~~</li>
	<li>For inline codes, use back ticks <code>( ` )</code>.</li>
	<li>For lists, use asterisk in front of text <code>( * )</code></li>
	<li>For headings, use # symbol in front of text, the number of # symbol is equal to the heading level</li>
</ul>