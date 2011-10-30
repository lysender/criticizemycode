<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller_Site {
	
	/**
	 * Keyword used for searching
	 *
	 * @var string
	 */
	protected $_keyword;
	
	/**
	 * Hash used for search validation
	 * 
	 * @var string
	 */
	protected $_hash;
	
	/**
	 * Ensure that searches are pre-approved
	 *
	 */
	public function before()
	{
		parent::before();
		
		$this->_check_get_request();
	}
	
	/**
	 * Checks if the successive search requests are valid
	 * and pre-approved
	 *
	 */
	protected function _check_get_request()
	{
		$this->_keyword = $this->session->get('search_keyword');
		$this->_hash = $this->session->get('search_hash');
		$invalid = FALSE;
		
		if (empty($this->_keyword) || empty($this->_hash))
		{
			$invalid = TRUE;
		}
		
		if ($this->_hash !== $this->request->param('hash'))
		{
			$invalid = TRUE;
		}
		
		if ($invalid)
		{
			if ($this->_prev_page)
			{
				$this->request->redirect($this->_prev_page);
			}
			else
			{
				$this->request->redirect('/');
			}
		}
	}
	
	/**
	 * Browse codes page
	 */
	public function action_index()
	{
		$this->template->head->title = 'Search';
		$this->template->head->styles[] = 'media/css/pagination.css';
		$this->view = View::factory('search/index')
			->bind('codes', $codes);
		
		$code = ORM::factory('code');
		
		$this->view->keyword = $this->_keyword;
		
		// Pagination
		$paginate = new Paginate;
		$base = Route::url('search', array('hash' => $this->_hash));
		
		$this->view->paginator = $paginate->render(
			$base,
			("$base/"),
			$count = $code->get_total_searched($this->_keyword),
			Model_Code::CODES_PER_PAGE,
			$page = $this->request->param('page', 1)
		);
		
		// Set codes to view
		$codes = $code->get_paged_search($count, $this->_keyword, $page)->as_array();
	}
}
