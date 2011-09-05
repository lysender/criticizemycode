<?php

return array(
	'username' => array(
		'not_empty' => 'Username is not entered',
		'regex' => 'Username must be composed of letters and numbers',
		'min_length' => 'Username must be at least :param2 characters',
		'max_length' => 'Username must be at most :param2 characters',
		'unique' => 'Username is already taken'
	),
	'email' => array(
		'not_empty' => 'Email is not entered',
		'min_length' => 'Email must be at least :param2 characters',
		'max_length' => 'Email must be at most :param2 characters',
		'email' => 'Email is invalid',
		'unique' => 'Email already exists'
	),
);