<p><strong>Note:</strong> You can use <a href="#">Markdown</a> syntax to format your post. For more information, <a href="#">click here</a>.</p>

<form id="code-comment-form" method="post" action="<?php echo $comment_post_url ?>" enctype="multipart/form-data">
	<div class="span-3">
		<label for="comment">Comment</label>
	</div>
	<div class="span-13 last">
		<textarea name="comment" id="comment" rows="10" cols="100"></textarea>
	</div>
	<div class="span-3">&nbsp;
		<input type="hidden" name="csrf" class="csrf-field" />
		<input type="hidden" name="code_id" id="code_id" value="<?php echo $code_id ?>" />
	</div>
	<div class="span-13 last">
		<input type="submit" name="submit" id="comment-submit" value="Submit" />
		<img src="/media/images/icons/spinner_grey.gif" class="ajax-spinner" />
		<div id="comment-messaging">
			<p class="error"></p>
			<p class="success"></p>
		</div>
	</div>
</form>