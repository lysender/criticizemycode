$(function()
{
	// Syntax highlighter
	$(".md-content-post pre:not(.debug) code").each(function()
	{
		// Get the parents identifier for language
		var id = $(this).parents(".md-content-post").attr("id");
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
		
		return this;
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
					CommentForm.reloadComments().createSuccessBlock("Comment has been posted");
				}
				else if (data.hasOwnProperty("error"))
				{
					// Show errors
					CommentForm.createErrorBlock(data.error);
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
		CommentForm.createErrorBlock("There was a problem while submitting your comment, reload the page and try again");
	},
	
	/**
	 * Ajax started
	 *
	 * @returns this
	 */
	startAjax: function() {
		$("img.ajax-spinner").show();
		
		// Hide messaging first and disable further posting
		$("#comment-messaging .alert-message").fadeOut();
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
	},
	
	/**
	 * Creates success message block
	 *
	 * @returns this
	 */
	createSuccessBlock: function(msg) {
		var html = '<div class="alert-message fade in success"><p></p></div>';
		var msgDiv = $("#comment-messaging");
		
		if (msgDiv.find(".alert-message.success").length == 0)
		{
			msgDiv.append(html);
		}
		
		msgDiv.find(".alert-message.success p").html(msg);
		msgDiv.find(".alert-message.success").fadeIn({
			"complete": function(){
				CommentForm.endAjax(true);
			}
		});
	},

	/**
	 * Creates error message block
	 *
	 * @returns this
	 */	
	createErrorBlock: function(msg) {
		var html = '<div class="alert-message fade in error"><p></p></div>';
		var msgDiv = $("#comment-messaging");
		
		if (msgDiv.find(".alert-message.error").length == 0)
		{
			msgDiv.append(html);
		}
		
		msgDiv.find(".alert-message.error p").html(msg);
		msgDiv.find(".alert-message.error").fadeIn({
			"complete": function(){
				CommentForm.endAjax(true);
			}
		});
	}
};
