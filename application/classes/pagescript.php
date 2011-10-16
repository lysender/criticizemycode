<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Page script helper class
 *
 * @package  Pagescript
 * @author   lysender
 * @uses     HTML
 */
class Pagescript {
	
	/**
	 * Javascript files
	 *
	 * @var array
	 */
	protected $_files = array();
	
	/**
	 * Global scripts
	 *
	 * @var array
	 */
	protected $_global_script = array();
	
	/**
	 * Scripts run on document ready
	 *
	 * @var array
	 */
	protected $_ready_script = array();
	
	/**
	 * Scripts that are run after document is fully loaded
	 *
	 * @var array
	 */
	protected $_deferred_script = array();
	
	/**
	 * Script used to focus on a certain form element
	 *
	 * @var string
	 */
	protected $_focus_script;
	
	/**
	 * @var Pagescript_Js
	 */
	protected $_js_adapter;
	
	/**
	 * Suffixed to the files to reload browser cache for the
	 * js files
	 *
	 * @var string
	 */
	protected $_cache_buster;
	
	/**
	 * Sets the cache buster suffix
	 *
	 * @param string $str
	 * @return Pagescript
	 */
	public function set_cache_buster($str)
	{
		$this->_cache_buster = $str;
		
		return $this;
	}
	
	/**
	 * Returns the cache buster suffix
	 *
	 * @return string
	 */
	public function get_cache_buster()
	{
		return $this->_cache_buster;
	}
	
	/**
	 * Adds a js file
	 *
	 * @param string $file
	 * @return Pagescript
	 */
	public function add_file($file)
	{
		$this->_files[] = $file;
		
		return $this;
	}
	
	/**
	 * Returns the js files array
	 *
	 * @return array
	 */
	public function get_files()
	{
		return $this->_files;
	}
	
	/**
	 * Returns the js adapter
	 *
	 * @return Pagescript_Js
	 */
	public function get_js_adapter()
	{
		if ( ! $this->_js_adapter instanceof Pagescript_Js)
		{
			throw new Exception('No JavaScript adapter set');
		}
		
		return $this->_js_adapter;
	}
	
	/**
	 * Sets the js adapter
	 *
	 * @param Pagescript_Js $js
	 * @return Pagescript
	 */
	public function set_js_adapter(Pagescript_Js $js)
	{
		$this->_js_adapter = $js;
		
		return $this;
	}
	
	/**
	 * Adds a global script code
	 *
	 * @param string $script
	 * @return Pagescript
	 */
	public function add_global_script($script)
	{
		$this->_global_script[] = $script;
		
		return $this;
	}
	
	/**
	 * Adds a js script on document ready
	 *
	 * @param string $script
	 * @return Pagescript
	 */
	public function add_ready_script($script)
	{
		$this->_ready_script[] = $script;
		
		return $this;
	}
	
	/**
	 * Adds a window.load script
	 *
	 * @param string $script
	 * @return Pagescript
	 */
	public function add_deferred_script($script)
	{
		$this->_deferred_script[] = $script;
		
		return $this;
	}
	
	/**
	 * Returns the global scripts as string
	 *
	 * @return string
	 */
	public function get_global_scripts()
	{
		return implode("\n", $this->_global_script);
	}
	
	/**
	 * Returns the document ready scripts as string
	 *
	 * @return string
	 */
	public function get_ready_scripts()
	{
		return implode("\n", $this->_ready_script);
	}
	
	/**
	 * Returns the window.load scripts as string
	 *
	 * @return string
	 */
	public function get_deferred_scripts()
	{
		return implode("\n", $this->_deferred_script);
	}
	
	/**
	 * Generate a script to focus on a form element
	 *
	 * @param string $field
	 * @return Pagescript
	 */
	public function set_focus_script($field)
	{
		$this->_focus_script = $this->get_js_adapter()
			->focus($field);
		
		return $this;
	}
	
	/**
	 * Returns the focus script
	 *
	 * @return string
	 */
	public function get_focus_script()
	{
		return $this->_focus_script;
	}
	
	/**
	 * Returns all scripts including the script tag,
	 * ready scripts and deferred scripts
	 *
	 * @return string
	 */
	public function get_all_scripts()
	{
		$contents = '';
		$ret = '';
		$js = $this->get_js_adapter();
		
		// Generate tags for the js files
		$c = $this->get_cache_buster();
		$files = $this->get_files();
		
		foreach ($files as $file)
		{
			$ret .= HTML::script($file.$c)."\n";
		}
		
		// Add focus script to ready scripts
		$this->add_ready_script($this->get_focus_script());
		
		$contents .= $this->get_global_scripts();
		$contents .= $js->ready($this->get_ready_scripts());
		$contents .= $js->deferred($this->get_deferred_scripts());
			
		$ret .= $js->generate_tag($contents);
		
		return $ret;
	}
}