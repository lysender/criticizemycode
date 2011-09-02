<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Asia/Manila');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (getenv('KOHANA_ENV') !== FALSE)
{
	Kohana::$environment = constant('Kohana::'.strtoupper(getenv('KOHANA_ENV')));
}

/**
 * Set generic salt for application wide hashing
 */
define('GENERIC_SALT', '5uctzl4g1VdaZmR4opZ3SvWCXeTvwqW5');

/**
 * Defines the version of the application
 */
define('APP_VERSION', '0.0.1');

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
	'base_url'   	=> '/',
	'index_file' 	=> FALSE,
	'errors'		=> TRUE,
	'profile'  		=> (Kohana::$environment == Kohana::DEVELOPMENT),
	'caching'    	=> (Kohana::$environment == Kohana::PRODUCTION)
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
$modules = array(
	'auth'       => MODPATH.'auth',       // Basic authentication
	// 'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	'database'   => MODPATH.'database',   // Database access
	// 'image'      => MODPATH.'image',      // Image manipulation
	'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	// 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
	// 'sprig'		 => MODPATH.'sprig',		// Sprig modeling inspired by Django
	// 'dc'		 => MODPATH.'dc'			// Dc's collection of libs
);

/**
 * Enable unittest module when in testing mode
 */
if (Kohana::$environment == Kohana::TESTING)
{
	$modules['unittest'] = MODPATH.'unittest'; // Unit testing
}
Kohana::modules($modules);
unset($modules);

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
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => 'index',
		'action'     => 'index',
	));

/**
 * Set cookie salt
 */
Cookie::$salt = GENERIC_SALT;

/**
 * Cache the routes
 */
Route::cache(TRUE);
