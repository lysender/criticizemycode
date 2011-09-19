<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Post a code
 *
 */
class Controller_Post extends Controller_Site {
	
	/**
	 * @var boolean
	 */
	protected $_no_auth = FALSE;
	
	/**
	 * Create code post form page
	 *
	 */
	public function action_index()
	{
		$this->template->title = 'Post';
		$this->template->styles['media/css/post.css'] = 'screen, projection';
		$this->view = View::factory('post/index');
		
		// Assign back the posted data to form
		$this->view->post = Arr::extract(
			$this->request->post(),
			array('title', 'post_content', 'language_id')
		);
		
		// Set default language to PHP
		$language = ORM::factory('language');
		
		// Set the language options
		$this->view->language_options = $language->get_select_options();
		
		if (empty($this->view->post['language_id']))
		{
			$language->where('name', '=', 'Php')->find();
			
			if ($language->loaded() && $language->name == 'Php')
			{
				$this->view->post['language_id'] = $language->id;
			}
		}
		
		
		if ($this->request->method() == Request::POST)
		{
			$this->_create_post();
		}
		else
		{
			$this->_page_setfocus('title');
		}
	}
	
	/**
	 * Creates the post and validates
	 *
	 * @return boolean
	 */
	protected function _create_post()
	{
		if ($this->request->post('csrf') == $this->_old_token)
		{
			$code = ORM::factory('code');
			
			try
			{
				$code->create_post($this->request->post());
				
				// Go to the post view url
				$this->session->set('success_message', 'Your code has been posted');
				
				$this->request->redirect($code->get_view_url());
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->_page_error($e->errors('code'));
			}
		}
		else
		{
			$this->_page_error('Session timeout, try again', 'title');
		}
	}
}