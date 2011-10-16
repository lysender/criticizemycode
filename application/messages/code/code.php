<?php

return array(
	'title' => array(
		'not_empty' => 'Title is not entered',
		'min_length' => 'Title must be at least :param2 characters',
		'max_length' => 'Title must be at most :param2 characters',
		'unique' => 'Title already exists, topic may exists or choose different title'
	),
	'slug_title' => array(
		'not_empty' => 'Slug title is not entered',
		'min_length' => 'Slug title must be at least :param2 characters',
		'max_length' => 'Slug title must be at most :param2 characters',
		'unique' => 'Slug title already exists'
	),	
	'post_content' => array(
		'not_empty' => 'Content is not entered',
		'min_length' => 'Content must be at least :param2 characters',
		'max_length' => 'Content must be at most :param2 characters',
	),
);