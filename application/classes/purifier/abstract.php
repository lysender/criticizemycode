<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Basic HTML purifier wrapper
 *
 */
abstract class Purifier_Abstract {
	
	/**
	 * @var boolean
	 */
	protected static $_is_init = FALSE;
	
	/**
	 * @var string
	 */
	protected $_encoding = 'UTF-8';
	
	/**
	 * @var string
	 */
	protected $_doctype = 'XHTML 1.0 Strict';
	
	/**
	 * @var HTMLPurifier
	 */
	protected $_purifier;

	/**
	 * 	Allowed tags and attributes
	 *
	 * 	@var string
	 */
	protected $_allowed = 'p, blockquote, ul, li, pre, code, strong, em, b,
		table[summary], thead, tbody, tfoot, tr, th[abbr], td[abbr],
		col, colgroup, caption';
	
	/**
	 * Initialize HTML purifier autoloader
	 *
	 */
	protected static function _init()
	{
		if ( ! self::$_is_init)
		{
			require_once APPPATH.'vendor/htmlpurifier/HTMLPurifier.auto.php';
			
			self::$_is_init = TRUE;
		}
	}
	
	/**
	 * __construct()
	 *
	 */
	public function __construct()
	{
		self::_init();
		
		$config = HTMLPurifier_Config::createDefault();
		$config->set('Core.Encoding', $this->_encoding);
		$config->set('HTML.Doctype', $this->_doctype);
		$config->set('HTML.Allowed', $this->_allowed);
		
		$this->_purifier = new HTMLPurifier($config);
	}
	
	/**
	 * Cleans the html string passed and returns a purified html
	 *
	 * @param string $html
	 * @return string
	 */
	public function purify($html)
	{
		return $this->_purifier->purify($html);
	}
}