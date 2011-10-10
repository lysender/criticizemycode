<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Page script helper class
 *
 */
class Pagescript {
	
	/**
	 * Scripts run on header (actually in footer for performance)
	 *
	 * @var array
	 */
	protected $_script = array();
	
	/**
	 * Scripts run on document ready
	 *
	 * @var array
	 */
	protected $_ready_script = array();
	
	/**
	 * Scripts run on window.load()
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
	 * Adds a js script code
	 *
	 * @param string $script
	 * @return Pagescript
	 */
	public function add_script($script)
	{
		$this->_script[] = $script;
		
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
	 * Returns the header scripts as string
	 *
	 * @return string
	 */
	public function get_scripts()
	{
		return implode("\n", $this->_script);
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
	public function set_focus($field)
	{
		$this->_focus_script = $this->get_js_adapter()
			->focus($field);
		
		return $this;
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
		
		$js = $this->get_js_adapter();
		
		$contents .= $this->get_scripts();
		$contents .= $js->ready_script($this->get_ready_scripts());
		$contents .= $js->deferred_script($this->get_deferred_scripts());
			
		return $js->script_tag($contents);
	}
}