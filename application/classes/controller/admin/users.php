<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Controller_Admin
{
	public function action_index()
	{
		$this->view = View::factory('admin/users/index');
		$this->template->head->title = 'User Management';
		$this->_bootstrap['twipsy'] = TRUE;
		$this->script->add_file('media/bootstrap/js/bootstrap-twipsy.js');

		$this->view->post = Arr::extract($this->request->post(), array(
			'date_registered',
			'date_registered_start',
			'date_registered_end',
			'username',
			'email'
		));

		if ($this->request->method() == Request::POST)
		{
			$this->view->users = $this->_search($this->view->post);
		}
	}

	/** 
	 * Returns a list of users registered for a given date
	 * 
	 * @param   array	$post
	 * @return  array
	 */
	protected function _search(array $post)
	{
		return ORM::factory('user')->custom_search($post, 20);
	}
}