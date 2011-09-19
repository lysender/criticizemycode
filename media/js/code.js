$(document).ready(function()
{
	// Syntax highlighter
	$('pre:not(.debug) code').each(function()
	{
		// Get the parents identifier for language
		var id = $(this).parents(".md-content").attr("id");
		var lang = id.split("-").pop();
		
		$(this).addClass("brush: " + lang);
	});

	SyntaxHighlighter.config.tagName = 'code';

	// Don't show the toolbar or line-numbers.
	SyntaxHighlighter.defaults.toolbar = false;
	SyntaxHighlighter.defaults.gutter = false;
	SyntaxHighlighter.all();

	// Striped tables
	$('#content tbody tr:even').addClass('alt');
});
