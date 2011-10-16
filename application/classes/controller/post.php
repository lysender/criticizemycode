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
	 * Don't track this page
	 *
	 * @var boolean
	 */
	protected $_track_page = FALSE;
	
	/**
	 * @var Model_Code
	 */
	protected $_code;
	
	/**
	 * @var Model_Language
	 */
	protected $_language;
	
	/**
	 * Create code post form page
	 *
	 */
	public function action_index()
	{
		$this->template->title = 'Post';
		$this->template->styles['media/css/post.css'] = 'screen, projection';
		$this->view = View::factory('post/index');
		
		// Initialize form post
		$this->_init_form_post();
		
		if ($this->request->method() == Request::POST)
		{
			$this->_create_post();
		}
		else
		{
			$this->get_pagescript()
				->set_focus_script('title');
		}
	}
	
	/**
	 * Initializes the form for form values, defaults
	 * and post defaults
	 *
	 */
	protected function _init_form_post()
	{
		// Assign back the posted data to form
		$this->view->post = Arr::extract(
			$this->request->post(),
			array('title', 'post_content', 'language_id')
		);
		
		// Set default language to Plain text
		$this->_language = ORM::factory('language');
		
		// Set the language options
		$this->view->language_options = $this->_language->get_select_options();
		
		if (empty($this->view->post['language_id']))
		{
			$this->_language->where('name', '=', 'Plain')->find();
			
			if ($this->_language->loaded() && $this->_language->name == 'Plain')
			{
				$this->view->post['language_id'] = $this->_language->id;
			}
		}
		
		// Initialize the values of the form fields when not posting
		if ($this->request->method() !== Request::POST)
		{
			if ($this->_code && $this->_code->loaded())
			{
				$this->view->post = Arr::extract(
					$this->_code->as_array(),
					array('title', 'post_content', 'language_id')
				);
			}
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
				$code->create_post($this->request->post(), $this->auth->get_user());
				
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
	
	/**
	 * Edit post
	 *
	 */
	public function action_edit()
	{
		$this->template->title = 'Edit post';
		$this->template->styles['media/css/post.css'] = 'screen, projection';
		$this->view = View::factory('post/edit');
		
		$this->_check_request();
		$this->view->code = $this->_code;
		
		// Initialize form post
		$this->_init_form_post();
		
		if ($this->request->method() == Request::POST)
		{
			$this->_update_post();
		}
		else
		{
			$this->get_pagescript()
				->set_focus_script('title');
		}
	}
	
	/**
	 * Checks the incoming request for editing a code post
	 *
	 */
	protected function _check_request()
	{
		$id = (int) $this->request->param('id');
		if ( ! $id)
		{
			$this->redirect_error('Invalid request');
		}
		
		$this->_code = ORM::factory('code', $id);
		if ( ! $this->_code->loaded())
		{
			$this->redirect_error('Code post not found');
		}
		
		if ($this->_code->user_id !== $this->auth->get_user()->id)
		{
			$this->redirect_error('No permission to edit post');
		}
	}
	
	/**
	 * Updates the post and validates
	 *
	 * @return boolean
	 */
	protected function _update_post()
	{
		if ($this->request->post('csrf') == $this->_old_token)
		{	
			try
			{
				$this->_code->update_post(
					$this->request->post(),
					$this->auth->get_user()
				);
				
				$this->redirect_success('Your code has been updated', $this->_code->get_view_url());
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