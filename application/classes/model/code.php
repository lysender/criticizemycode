<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Code model class
 *
 */
class Model_Code extends ORM {
	
	const CODES_PER_PAGE = 10;
	
	/**
	 * Code post belons to user
	 *
	 * @var array
	 */
	protected $_belongs_to = array(
		'user' => array(
			'model' => 'user',
			'foreign_key' => 'user_id'
		),
		'language' => array(
			'model' => 'language',
			'foreign_key' => 'language_id'
		)
	);
	
	protected $_table_columns = array(
		'id' => array(),
		'user_id' => array(),
		'language_id' => array(),
		'title' => array(),
		'slug_title' => array(),
		'post_content' => array(),
		'date_posted' => array(),
		'date_modified' => array(),
	);
	
	/**
	 * Generates a slug based on the title of the code post
	 *
	 * @param string $title
	 * @return string
	 */
	public static function generate_slug($title)
	{
		// Convert all to ascii first
		$slug = UTF8::transliterate_to_ascii($title);
		
		// Lower case and slug style
		$slug = strtolower($slug);
		
		$slug = str_replace(array(' ', '+'), array('-', 'plus'), $slug);
		$slug = preg_replace('/[^0-9a-zA-Z-_]/', '', $slug);
		
		return Text::limit_chars($slug, 100, '');
	}
	
	/**
	 * Code post rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			'title' => array(
				array('not_empty'),
				array('min_length', array(':value', 5)),
				array('max_length', array(':value', 100))
			),
			'post_content' => array(
				array('not_empty'),
				array('min_length', array(':value', 50)),
				array('max_length', array(':value', 3000))
			)
		);
	}
	
	/**
	 * Creates a code post
	 *
	 * @param array $values
	 * @return boolean
	 * @throws ORM_Validation_Exception
	 */
	public function create_post(array $values)
	{
		// Generate slug if present
		if ( ! empty($values['title']))
		{
			$this->slug_title = self::generate_slug($values['title']);
		}
		
		$this->values($values, array('title', 'post_content', 'language_id'));
		
		$this->user = Auth::instance()->get_user();
		
		if (empty($this->user) || ! $this->user->loaded())
		{
			throw new Exception('User is not properly set for creating code post');
		}
		
		$this->date_posted = time();
		
		return $this->create();
	}
	
	/**
	 * Returns the absolute URL for viewing a code post
	 *
	 * @return string
	 */
	public function get_view_url()
	{
		return Route::url('view_code', array(
			'id' => $this->id,
			'slug' => $this->slug_title
		));
	}
	
	/**
	 * Returns the total number of pages
	 * for a given total record count
	 *
	 * @param int $total
	 * @return int
	 */
	public function get_total_pages($total)
	{
		$ret = ceil($total / self::CODES_PER_PAGE);
		
		if ($ret > 0)
		{
			return (int) $ret;
		}
		
		return 1;
	}
	
	/**
	 * Returns paginated item records
	 *
	 * @param int $total
	 * @param int $page
	 * @param string $sort
	 * @return array
	 */
	public function get_paged($total, $page = 1, $sort = 'DESC')
	{		
		$page = (int) $page;
		
		// Pre calculate totals
		$total_pages = $this->get_total_pages($total);
		
		// Determine the correct page
		if ($page < 1)
		{
			$page = 1;
		}
		
		// Make sure the page does not exceed total pages
		if ($page > $total_pages)
		{
			$page = $total_pages;
		}
		
		$offset = ($page - 1) * self::CODES_PER_PAGE;
		
		return ORM::factory('code')
			->limit(self::CODES_PER_PAGE)
			->offset($offset)
			->order_by('date_posted', $sort)
			->find_all();
	}
	
	/**
	 * Returns the total number of records that match the
	 * searched keyword
	 *
	 * @param string $keyword
	 * @return int
	 */
	public function get_total_searched($keyword)
	{
		return ORM::factory('code')
			->where('title', 'LIKE', "%$keyword%")
			->count_all();
	}
	
	/**
	 * Returns the records that matched the search keyword
	 *
	 * @param int $total
	 * @param string $keyword
	 * @param int $page
	 * @param string $sort
	 * @return array
	 */
	public function get_paged_search($total, $keyword, $page = 1, $sort = 'DESC')
	{
		$page = (int) $page;
		
		// Pre calculate totals
		$total_pages = $this->get_total_pages($total);
		
		// Determine the correct page
		if ($page < 1)
		{
			$page = 1;
		}
		
		// Make sure the page does not exceed total pages
		if ($page > $total_pages)
		{
			$page = $total_pages;
		}
		
		$offset = ($page - 1) * self::CODES_PER_PAGE;
		
		return ORM::factory('code')
			->where('title', 'LIKE', "%$keyword%")
			->limit(self::CODES_PER_PAGE)
			->offset($offset)
			->order_by('date_posted', $sort)
			->find_all();		
	}
}

