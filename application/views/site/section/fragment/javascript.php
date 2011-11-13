<?php
	$js = $script->get_adapter();
	
	$script->add_global_script(
		$js->js_var('base_url', URL::site('/'))
	);
	
	// Insert anti-csrf token
	if (isset($csrf_token) && $csrf_token)
	{
		$script->add_ready_script('$(".csrf-field").val("'.$csrf_token.'");');
	}
	
	// Insert logout script for logged in user
	if (isset($user_logged_in) && $user_logged_in)
	{
		$script->add_ready_script('$("#h-logout-link").click(function() {'."\n"
			.'$("#logout-form").submit();'."\n"
			."return false;\n"
			."});"
		);
	}
	
	// Trigger bootstrap alert script
	if (isset($alert) && $alert)
	{
		$script->add_ready_script('$(".alert-message").alert();');
	}

	// Trigger twipsy if set
	if (isset($twipsy) && $twipsy)
	{
		$script->add_ready_script('$(".apply-twipsy").twipsy({live: true});');
	}
	
	echo $script->render();
