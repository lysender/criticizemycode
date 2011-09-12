<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Browse extends Controller_Site
{
	/**
	 * Browse codes page
	 */
	public function action_index()
	{
		$this->template->title = 'Browse codes';
		$this->template->styles['media/css/pagination.css'] = 'screen, projection';
		$this->view = View::factory('browse/index')
			->bind('codes', $codes);
		
		$code = ORM::factory('code');
		
		// Pagination
		$paginate = new Paginate;
		
		$this->view->paginator = $paginate->render(
			'/browse',
			('/browse/page/'),
			$count = $code->count_all(),
			Model_Code::CODES_PER_PAGE,
			$page = $this->request->param('page', 1)
		);
		
		// Set codes to view
		$codes = $code->get_paged($count, $page);
	}
}
