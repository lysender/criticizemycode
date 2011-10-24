<form class="form-stacked" id="code-comment-form" method="post" action="<?php echo $comment_post_url ?>" enctype="multipart/form-data">
	<p><strong>Note:</strong> You can use <a href="#">Markdown</a> syntax to format your post. For more information, <a href="#">click here</a>.</p>
	
	<fieldset>
		<div class="clearfix">
			<label for="comment">Comment</label>
			<div class="input">
				<textarea name="comment" id="comment" rows="10" cols="100"></textarea>
			</div>
		</div>
		<div class="clearfix">
			<div class="input">
				<input class="btn primary" type="submit" name="submit" id="comment-submit" value="Submit" />
				<img src="/media/images/icons/spinner_grey.gif" class="ajax-spinner" />
				<input type="hidden" name="csrf" class="csrf-field" />
				<input type="hidden" name="code_id" id="code_id" value="<?php echo $code_id ?>" />
				<div id="comment-messaging">
					<div class="alert-message fade in error">
						<p></p>
					</div>
					<div class="alert-message fade in success">
						<p></p>
					</div>
				</div>
			</div>
		</div>
	</fieldset>
</form>