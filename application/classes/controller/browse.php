<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Browse extends Controller_Site
{
	/**
	 * Browse codes page
	 */
	public function action_index()
	{
		$this->template->title = 'Browse codes';
		$this->view = View::factory('browse/index');
	}
	
	/**
	 * View a single code post
	 *
	 */
	public function action_code()
	{
		
	}
}
