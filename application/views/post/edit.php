<h1>Edit your awesome code</h1>

<div id="form-wrapper">
	<?php if ( ! empty($error_message)): ?>
	<p class="error"><?php echo $error_message ?></p>
	<?php endif ?>
	
	<?php if ( ! empty($success_message)): ?>
	<p class="success"><?php echo $success_message ?></p>
	<?php endif ?>
	
	<p><strong>Note:</strong> You can use <a href="#">Markdown</a> syntax to format your post. For more information, <a href="#">click here</a>.</p>
	
	<form action="<?php echo URL::site($code->get_edit_url()) ?>" method="post" enctype="multipart/form-data">
		<div class="span-3"><label for="title">Title</label></div>
		<div class="span-13 last"><input type="text" name="title" id="title" value="<?php echo $post['title'] ?>" /></div>

		<div class="span-3"><label for="post_content">Content</label></div>
		<div class="span-13 last"><textarea rows="20" cols="300" name="post_content" id="post_content"><?php echo $post['post_content'] ?></textarea></div>

		<div class="span-3"><label for="language_id">Language</label></div>
		<div class="span-13 last">
			<?php echo Form::select('language_id', $language_options, $post['language_id'], array('id' => 'language_id')) ?>
		</div>
		
		<div class="span-3">&nbsp; <input type="hidden" name="csrf" id="csrf" class="csrf-field" /></div>
		<div class="span-13 last"><input type="submit" name="submit" id="submit" value="Post code" /></div>
	</form>
</div>