<h1>Latest wicked codes</h1>

<?php if ( ! empty($error_message)): ?>
<p class="error"><?php echo $error_message ?></p>
<?php endif ?>

<?php if ( ! empty($success_message)): ?>
<p class="success"><?php echo $success_message ?></p>
<?php endif ?>

<?php echo Request::factory('/widgets/latestcode/index')->execute()->body() ?>