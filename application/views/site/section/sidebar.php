<h1>What is this all about?</h1>

<p><strong>CriticizeMyCode.com</strong> is an online community who showcase the best, worst and
most wicked codes ever written.</p>

<p>It's ultimate goal is to tell what's the best practice, what is wrong
and what should be the right for solving a certain problem.</p>

<p>Fear not to show your code!</p>

<h3>Markdown tips</h3>

<ul>
	<li>To write codes, indent the line with 4 spaces.</li>
	<li>Alternatively, you can also wrap them inside <code>~~~</code> where each <code>~~~</code> is on a single line.</li>
	<li>For inline codes, use back ticks (<code>`</code>).</li>
	<li>Wrap with single underscore or asterisk for emphasized texts like <code>*emphasized*</code> or <code>_also emphasized_</code>.</li>
	<li>Wrap with double underscore or asterisk for bolded texts like <code>**bolded**</code> or <code>__also bolded__</code>.</li>
	<li>For lists, use asterisk in front of each item on a list (<code>*</code>), be sure to put a single space before the text.</li>
	<li>For other Markdown syntax allowed, <a href="#">click here</a>.</li>
</ul>

<h3>Latest codes</h3>

<?php echo Request::factory('/widgets/latestcode/sidebar')->execute()->body() ?>