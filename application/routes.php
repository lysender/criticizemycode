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
 * Router for cron front-end
 */
Route::set('cron', 'cron(/<controller>(/<action>(/<id>(/<param2>(/<param3>)))))')
	->defaults(array(
		'directory'	 => 'cron',
		'controller' => 'index',
		'action'     => 'index',
	));

/**
 * Router for inventory group of pages
 */
Route::set('inventory', 'inventory(/<controller>(/<action>(/<id>(/<param2>(/<param3>)))))')
	->defaults(array(
		'directory'	 => 'inventory',
		'controller' => 'index',
		'action' 	 => 'index'
	));

/**
 * Router for sales group of pages
 */
Route::set('sales', 'sales(/<controller>(/<action>(/<id>(/<param2>(/<param3>)))))')
	->defaults(array(
		'directory'	 => 'sales',
		'controller' => 'index',
		'action' 	 => 'index'
	));

/**
 * Router for sales group of pages
 */
Route::set('report', 'report(/<controller>(/<action>(/<id>(/<param2>(/<param3>)))))')
	->defaults(array(
		'directory'	 => 'report',
		'controller' => 'index',
		'action' 	 => 'index'
	));

/**
 * Router for sales group of pages
 */
Route::set('security', 'security(/<controller>(/<action>(/<id>(/<param2>(/<param3>)))))')
	->defaults(array(
		'directory'	 => 'security',
		'controller' => 'index',
		'action' 	 => 'index'
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
 * Router for search
 *
 */
Route::set('search', 'search(/<hash>(/<page>))', array('hash' => '[0-9a-zA-Z]++', 'page' => '[0-9]++'))
	->defaults(array(
		'controller' => 'search',
		'action' => 'index'
	));

/**
 * Router for codes group of pages
 */
Route::set('code', 'code(/<controller>(/<action>(/<id>(/<param2>(/<param3>)))))')
	->defaults(array(
		'directory'	 => 'code',
		'controller' => 'index',
		'action' 	 => 'index'
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