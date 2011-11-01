<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Post a code
 *
 */
class Controller_Comment extends Controller_Site {
	
	/**
	 * Use no template
	 *
	 * @var boolean
	 */
	public $auto_render = FALSE;
	
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
	 * @var boolean
	 */
	protected $_ajax_only = TRUE;
	
	/**
	 * Dont use tokens so that they will not auto renew
	 *
	 * @var boolean
	 */
	protected $_use_token = FALSE;
	
	/**
	 * @var Model_Code
	 */
	protected $_code;
	
	/**
	 * @var Model_Code_Comment
	 */
	protected $_comment;
	
	/**
	 * Various checks before executing the main action
	 *
	 */
	public function before()
	{
		parent::before();
		
		// All requests must be of POST method
		if ($this->request->method() !== Request::POST)
		{
			$this->send_forbidden_headers();
		}
		
		$this->_check_code_request();
	}
	
	/**
	 * Checks whether the request is for a valid post
	 *
	 */
	protected function _check_code_request()
	{
		$code_id = $this->request->param('code_id');
		
		if ( ! $code_id)
		{
			$this->send_forbidden_headers();
		}
		
		$this->_code = ORM::factory('code', $code_id);
		
		if ( ! $this->_code->loaded())
		{
			$this->send_forbidden_headers();
		}
	}
	
	/**
	 * Checks whether the request is for a valid comment to edit
	 *
	 */
	protected function _check_comment_request()
	{
		$comment_id = $this->request->param('comment_id');
		
		if ( ! $comment_id)
		{
			$this->send_forbidden_headers();
		}
		
		$this->_comment = ORM::factory('comment', $comment_id);
		
		if ( ! $this->_comment)
		{
			$this->send_forbidden_headers();
		}
	}

	/** 
	 * Checks if the token is valid for the request
	 * Does not renew the token but instead reuse the old token
	 *
	 * @return  boolean
	 */
	protected function _check_csrf_token()
	{
		$token = $this->request->post('csrf_token');
		$old_token = $this->session->get('csrf_token');
		
		if ($token !== $old_token)
		{
			return FALSE;
		}

		return TRUE;
	}
	
	/**
	 * Posts a comment for a certain code post
	 *
	 */
	public function action_post()
	{
		// Extract post parameters
		$post = Arr::extract(
			$this->request->post(),
			array('comment', 'language_id')
		);
		$ret = array();
		
		$comment = ORM::factory('comment')->values($post);
		$comment->code_id = $this->_code->id;
		$comment->user_id = $this->auth->get_user()->id;
		$comment->date_posted = time();
		
		if ($this->_check_csrf_token())
		{
			try
			{
				$comment->create();
				$ret['success'] = TRUE;
			}
			catch (ORM_Validation_Exception $e)
			{
				$ret['error'] = $this->_format_errors($e->errors('comment'));
			}
		}
		else
		{
			$ret['error'] = 'Session time out. Reload the page and try again.';
		}
		
		$this->response->headers('Content-Type', 'application/json');
		$this->response->body(json_encode($ret));
	}
	
	/**
	 * Formats the error to be json friendly
	 *
	 * @param array $errors
	 * @return string
	 */
	protected function _format_errors($errors)
	{
		return implode('\n', $errors);
	}
}