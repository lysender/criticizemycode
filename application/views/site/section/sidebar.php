<h3>Markdown tips</h3>

<ul>
	<li>To write codes, indent the line with 4 spaces.</li>
	<li>Alternatively, you can also wrap them inside <code>~~~</code> where each <code>~~~</code> is on a single line.</li>
	<li>For inline codes, use back ticks (<code>`</code>).</li>
	<li>Wrap with single underscore or asterisk for emphasized texts like <code>*emphasized*</code> or <code>_also emphasized_</code>.</li>
	<li>Wrap with double underscore or asterisk for bolded texts like <code>**bolded**</code> or <code>__also bolded__</code>.</li>
	<li>For lists, use asterisk in front of each item on a list (<code>*</code>), be sure to put a single space before the text.</li>
	<li>For more information, <a href="<?php echo URL::site('/help/markdown') ?>">click here</a>.</li>
</ul>

<h3>Latest codes</h3>

<?php echo Request::factory('/widgets/latestcode/sidebar')->execute()->body() ?>