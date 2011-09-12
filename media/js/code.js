$(document).ready(function()
{
	// Syntax highlighter
	$('pre:not(.debug) code').each(function()
	{
		$(this).addClass('brush: php');
	});

	SyntaxHighlighter.config.tagName = 'code';

	// Don't show the toolbar or line-numbers.
	SyntaxHighlighter.defaults.toolbar = false;
	SyntaxHighlighter.defaults.gutter = false;
	SyntaxHighlighter.all();

	// Striped tables
	$('#content tbody tr:even').addClass('alt');
});
