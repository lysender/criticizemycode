<h1>User Management</h2>

<form action="/admin/users" method="post" id="search-user-form">
	<fieldset>
		<div class="clearfix">
			<label for="date_registered">By date registered</label>
			<div class="input">
				<div class="span3">
					<input type="text" name="date_registered" id="date_registered" placeholder="Date: yyyy-mm-dd" class="span3" value="<?php echo $post['date_registered'] ?>" />
				</div>
				<div class="span9">
					<span>or date range from</span>
					<input type="text" name="date_registered_start" id="date_registered_start" placeholder="Date: yyyy-mm-dd" class="span3" value="<?php echo $post['date_registered_start'] ?>" />
					<span>to</span>
					<input type="text" name="date_registered_end" id="date_registered_end" placeholder="Date: yyyy-mm-dd" class="span3" value="<?php echo $post['date_registered_end'] ?>" />
				</div>
			</div>
		</div>
		<div class="clearfix">
			<label for="username">By name or email</label>
			<div class="input">
				<div class="span3">
					<input type="text" name="username" id="username" placeholder="Ex: peter" class="span3" value="<?php echo $post['username'] ?>" />
				</div>
				<div class="span9">
					<input type="text" name="email" id="email" placeholder="Ex: peter@yahoo.com" class="span4" value="<?php echo $post['email'] ?>" />
					<input type="submit" name="submit_search" id="submit_search" value="Search users" class="btn primary" />
				</div>
			</div>
		</div>
	</fieldset>
</form>

<p><strong>Note:</strong> For username and email, you can add a wildcard character.
Example for username: <code>peter%</code> or <code>%mary%</code> and for email <code>%@yahoo.com</code>.</p>

<?php if ( ! empty($users)): ?>
<table class="zebra-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th class="yellow">Username</th>
			<th class="blue">Email</th>
			<th class="green">Last login</th>
			<th class="green">Date registered</th>
			<th class="red">Action</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo $user['id'] ?></td>
			<td><?php echo HTML::chars($user['username']) ?></td>
			<td><?php echo HTML::chars($user['email']) ?></td>
			<td><span class="apply-twipsy" data-original-title="<?php echo $user['pretty_last_login'] ?>"><?php echo $user['fuzzy_last_login'] ?></span></td>
			<td><span class="apply-twipsy" data-original-title="<?php echo $user['pretty_date_registered'] ?>"><?php echo $user['fuzzy_date_registered'] ?></span></td>
			<td><a href="#" class="red">&cross; Del</a></td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>
<?php endif ?>
