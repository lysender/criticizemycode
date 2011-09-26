$(function()
{
	// Syntax highlighter
	$("pre:not(.debug) code").each(function()
	{
		// Get the parents identifier for language
		var id = $(this).parents(".md-content").attr("id");
		var lang = id.split("-").pop();
		
		$(this).addClass("brush: " + lang);
	});

	SyntaxHighlighter.config.tagName = "code";

	// Don"t show the toolbar or line-numbers.
	SyntaxHighlighter.defaults.toolbar = false;
	SyntaxHighlighter.defaults.gutter = false;
	SyntaxHighlighter.all();

	// Striped tables
	$("#content tbody tr:even").addClass("alt");
	
	// For code comment submission
	$("#code-comment-form").submit(CommentForm.submit);
});

/**
 * Handles comment form management
 *
 * @type Object
 */
window.CommentForm = {
	/**
	 * Reloads the current page code comments
	 *
	 * @returns this
	 */
	reloadComments: function() {
		var id = $("#code_id").val();
		var url = "/widgets/comment/" + id;
		
		$.get(url, function(data){
			if (data)
			{
				$("#post-comment-w").html(data);
			}
			
			$("#comment").text("");
		});
	},
	
	/**
	 * Event
	 *
	 * Triggers when the comment for is submitted
	 *
	 */
	submit: function(e) {
		CommentForm.startAjax();
		
		var action = this.action;
		var postData = {
			"comment": $("#comment").val(),
			"csrf": $(this).find("input[name=csrf]").val()
		};
		
		$.post(action, postData, function(data){
			if (data)
			{
				if (data.hasOwnProperty("success"))
				{
					// Reload comments
					CommentForm.reloadComments();
					
					$("#comment-messaging p.success").html("Comment has been posted").fadeIn({
						"complete": function(){
							CommentForm.endAjax(true);
						}
					});
				}
				else if (data.hasOwnProperty("error"))
				{
					// Show errors
					$("#comment-messaging p.error").html(data.error).fadeIn({
						"complete": function(){
							CommentForm.endAjax(false);
						}
					});
				}
				else
				{
					CommentForm.genericError();
				}
			}
			else
			{
				CommentForm.genericError();
			}
		}, "json");
		
		return false;
	},
	
	/**
	 * Shows a generic error
	 *
	 * @returns this
	 */
	genericError: function() {
		$("#comment-messaging p.error").html("There was a problem while submitting your comment, reload the page and try again")
			.fadeIn({
				"complete": function() {
					CommentForm.endAjax();
				}
			});
	},
	
	/**
	 * Ajax started
	 *
	 * @returns this
	 */
	startAjax: function() {
		$("img.ajax-spinner").show();
		
		// Hide messaging first and disable further posting
		$("#comment-messaging p").fadeOut();
		$("#comment-submit").attr("disabled", "disabled");
		
		return this;
	},
	
	/**
	 * Ajax completes
	 *
	 * @returns this
	 */
	endAjax: function(clear) {
		$("img.ajax-spinner").hide();
		$("#comment-submit").removeAttr("disabled");
		
		if (clear)
		{
			$("#comment").val("");
		}
		
		return this;
	}
};
