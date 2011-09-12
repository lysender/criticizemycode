<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Contains the latest codes
 *
 */
class Controller_Widgets_Latestcode extends Controller {
	
	/**
	 * Latest codes wide display
	 *
	 */
	public function action_index()
	{
		$view = View::factory('widgets/latestcode/index')
			->bind('codes', $codes);
		
		$codes = ORM::factory('code')
			->order_by('date_posted', 'DESC')
			->limit(10)
			->find_all();
		$this->request->response()->body($view);
	}
	
	/**
	 * Latest code sidebar
	 *
	 */
	public function action_sidebar()
	{
		$view = View::factory('widgets/latestcode/sidebar')
			->bind('codes', $codes);
		
		$codes = ORM::factory('code')
			->order_by('date_posted', 'DESC')
			->limit(10)
			->find_all();
		$this->request->response()->body($view);
	}
}