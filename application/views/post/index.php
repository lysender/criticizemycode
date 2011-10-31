<h1>Post your awesome code</h1>

<div id="form-wrapper">
	<?php echo $message ?>
	
	<p><strong>Note:</strong> You can use <a href="#">Markdown</a> syntax to format your post. For more information, <a href="#">click here</a>.</p>
	
	<form class="form-stacked" action="<?php echo URL::site('/post') ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="clearfix">
				<label for="title">Title</label>
				<div class="input">
					<input class="span10" type="text" name="title" id="title" value="<?php echo $post['title'] ?>" />
				</div>
			</div>
			
			<div class="clearfix">
				<label for="post_content">Content</label>
				<div class="input">
					<textarea class="span10" rows="20" cols="300" name="post_content" id="post_content"><?php echo $post['post_content'] ?></textarea>
				</div>
			</div>
			
			<div class="clearfix">
				<label for="language_id">Language</label>
				<div class="input">
					<?php echo Form::select('language_id', $language_options, $post['language_id'], array('id' => 'language_id', 'class' => 'span5')) ?>
				</div>
			</div>
			
			<div class="clearfix">
				<div class="input">
					<input class="btn primary" type="submit" name="submit" id="submit" value="Post code" />
					<input type="hidden" name="csrf" id="csrf" class="csrf-field" />
				</div>
			</div>
		</fieldset>
	</form>
</div>