<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Code post view page
 *
 */
class Controller_Code_Single extends Controller_Site {
	
	/**
	 * @var Model_Code
	 */
	protected $_code;
	
	/** 
	 * Initialize markdown environment
	 */
	public function before()
	{
		if (defined('MARKDOWN_PARSER_CLASS'))
		{
			throw new Kohana_Exception('Markdown parser already registered. Live documentation will not work in your environment.');
		}

		// Use customized Markdown parser
		define('MARKDOWN_PARSER_CLASS', 'Kodoc_Markdown');

		if ( ! class_exists('Markdown', FALSE))
		{
			// Load Markdown support
			require Kohana::find_file('vendor', 'markdown/markdown');
		}

		parent::before();
	}
	
	/**
	 * Code view page
	 *
	 */
	public function action_index()
	{
		$this->_check_request();
		
		$this->template->title = $this->_code->title;
		$this->view = View::factory('code/single/index');
		
		$this->view->title = $this->_code->title;
		$this->view->marked_up_content = Markdown($this->_code->post_content);
	}
	
	/**
	 * Checks the request if valid
	 */
	protected function _check_request()
	{
		// Retrieve code post
		$id = $this->request->param('id');
		$slug = $this->request->param('slug');
		
		if (empty($id) || empty($slug))
		{
			$this->session->set('error_message', 'Code post not found');
			$this->request->redirect('/');
		}
		
		$this->_code = ORM::factory('code', array(
			'id' => $id,
			'slug_title' => $slug
		));
		
		if ( ! $this->_code->loaded())
		{
			$this->session->set('error_message', 'Code post not found');
			$this->request->redirect('/');
		}
	}
}