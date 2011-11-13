<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Base for all controllers which contains several custom methods
 * used for basic site features and request validations
 *
 */
class Controller_Admin_Index extends Controller_Admin
{
	public function action_index()
	{
		$this->view = View::factory('admin/index/index');
	}
}