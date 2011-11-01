<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Site
{
	/** 
	 * Use hero template
	 * 
	 * @var   string or View
	 */
	public $template = 'site/template/hero';

	/**
	 * Front page
	 */
	public function action_index()
	{
		$this->template->title = 'Latest codes';
		$this->template->updates = View::factory('index/updates');
		
		$this->view = View::factory('index/hero');
	}
}
