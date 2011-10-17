<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Code post view page
 *
 */
class Controller_Browse_Code extends Controller_Site {
	
	/**
	 * @var Model_Code
	 */
	protected $_code;
	
	/**
	 * @var boolean
	 */
	protected $_user_can_edit = FALSE;
	
	/** 
	 * Initialize markdown environment
	 */
	public function before()
	{
		parent::before();
		
		if (defined('MARKDOWN_PARSER_CLASS'))
		{
			throw new Kohana_Exception('Markdown parser already registered. Live documentation will not work in your environment.');
		}

		if ( ! defined('MARKDOWN_VERSION'))
		{
			// Load Markdown support
			require Kohana::find_file('vendor', 'markdown/markdown');
		}
		
		$this->template->styles['media/css/code.css'] = 'all';
		$this->template->styles['media/sh/styles/shCore.css'] = 'screen';
		$this->template->styles['media/sh/styles/shThemeRDark.css'] = 'screen';

		$this->template->scripts[] = 'media/js/code.js';
		$this->template->scripts[] = 'media/sh/scripts/shCore.js';
	}
	
	/**
	 * Code view page
	 *
	 */
	public function action_index()
	{
		$this->_check_request();
		
		$this->template->title = $this->_code->title;
		$this->view = View::factory('browse/code/index');
		
		$this->template->scripts[] = 'media/sh/scripts/shBrush'.$this->_code->language->name.'.js';
		
		$this->view->code = $this->_code;
		$this->view->user_can_edit = $this->_user_can_edit;
		
		$purifier = new Purifier_Post;
		$this->view->marked_up_content = $purifier->purify(Markdown($this->_code->post_content));
		
		if ($this->auth->get_user())
		{
			// Set default language to Plain text
			$language = ORM::factory('language');
			
			// Set the language options
			$language_options = $language->get_select_options();
			$language->where('name', '=', 'Plain')->find();
			$default_language = NULL;
			
			if ($language->loaded() && $language->name == 'Plain')
			{
				$default_language = $language->id;
			}
			
			$comment_post_url = Route::url('comment', array(
				'action' => 'post',
				'code_id' => $this->_code->id
			));
			$this->view->comment_form = View::factory('comment/form')
				->set('code_id', $this->_code->id)
				->set('language_options', $language_options)
				->set('default_language', $default_language)
				->set('comment_post_url', $comment_post_url);
		}
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
			throw new HTTP_Exception_404('Code post not found');
		}
		
		$this->_code = ORM::factory('code', array(
			'id' => $id,
			'slug_title' => $slug
		));
		
		if ( ! $this->_code->loaded())
		{
			throw new HTTP_Exception_404('Code post not found');
		}
		
		// Check if the current user can edit the post
		if ($user = $this->auth->get_user())
		{
			if ($this->_code->user && $this->_code->user->id == $user->id)
			{
				$this->_user_can_edit = TRUE;
			}
		}
	}
}
