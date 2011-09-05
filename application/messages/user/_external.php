<?php

return array(
	'password' => array(
		'not_empty' => 'Password is not entered',
		'min_length' => 'Password must be at least :param2 characters',
		'max_length' => 'Password must be at most :param2 characters',
	),
	'password_confirm' => array(
		'matches' => 'Passwords did not match'
	),
);