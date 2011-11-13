<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Comments extends Controller_Admin
{
	public function action_index()
	{
		$this->view = View::factory('admin/index/index');
	}
}