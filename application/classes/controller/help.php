<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Help extends Controller_Site
{
	/**
	 * Help center index page
	 */
	public function action_index()
	{
		$this->template->head->title = 'Help Center';
		$this->view = View::factory('help/index');
	}

	/** 
	 * Markdown help page
	 */
	public function action_markdown()
	{
		$this->template->head->title = 'Help Center - Markdown';
		$this->view = View::factory('help/markdown');
	}
}
