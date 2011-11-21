<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Error router
 */
Route::set('error', 'error/<action>/<origuri>/<message>', array('action' => '[0-9]++', 'message' => '.+', 'origuri' => '.+'))
->defaults(array(
    'controller' => 'error',
	'action'	 => 'index'
));

/**
 * Router for browsing codes and supports pagination
 *
 */
Route::set('browse_code', 'browse(/<label>(/<page>))', array('label' => 'page', 'page' => '[0-9]++'))
	->defaults(array(
		'controller' => 'browse',
		'action' => 'index',
		'page' => 1
	));

/**
 * Router for browsing single code post
 *
 */
Route::set('view_code', 'browse/code/<id>/<slug>', array('id' => '[0-9]++', 'slug' => '[0-9a-z-_]++'))
	->defaults(array(
		'directory' => 'browse',
		'controller' => 'code',
		'action' => 'index'
	));

/** 
 * Openconnect controller group
 *
 */
Route::set('openconnect', 'openconnect/<controller>(/<action>)')
	->defaults(array(
		'directory' => 'openconnect',
		'action' => 'index'
	));

/**
 * Router for search
 *
 */
Route::set('search', 'search(/<hash>(/<page>))', array('hash' => '[0-9a-zA-Z]++', 'page' => '[0-9]++'))
	->defaults(array(
		'controller' => 'search',
		'action' => 'index'
	));

/**
 * Router for posting and editing comments
 *
 */
Route::set('comment', 'comment/<action>/<code_id>(/<comment_id>)', array('code_id' => '[0-9]++', 'comment_id' => '[0-9]++'))
	->defaults(array(
		'controller' => 'comment',
		'action' => 'post'
	));

/**
 * Routes for widgets
 *
 * Code widget
 *
 */
Route::set('widgets_latestcode', 'widgets/latestcode(/<action>)')
	->defaults(array(
		'directory'	 => 'widgets',
		'controller' => 'latestcode',
		'action' 	 => 'index'
	));

/**
 * Routes for widgets
 *
 * Comments widget
 *
 */
Route::set('widgets_comment', 'widgets/comment/<code_id>')
	->defaults(array(
		'directory'	 => 'widgets',
		'controller' => 'comment',
		'action' 	 => 'index'
	));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => 'index',
		'action'     => 'index',
	));

/**
 * Cache the routes
 */
//Route::cache(TRUE);