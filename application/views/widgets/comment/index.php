<?php if (  ! empty($comments)): ?>
	<?php foreach ($comments as $index => $comment): ?>
		<div class="comment-w span10">
			<div class="md-content"><?php echo $comment['comment'] ?></div>
			<div class="comment-author">
				by <a href="#"><?php echo $comment['author'] ?></a>
				<span class="comment-date"><?php echo $comment['date_posted'] ?></span>
			</div>
		</div>
	<?php endforeach ?>
<?php else: ?>
	<p>There are no comments yet.</p>
<?php endif ?>
