<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Code model class
 *
 * @package Model_Code
 * @author Lysender <leonel@lysender.com>
 */
class Model_Code extends ORM {
	
	const CODES_PER_PAGE = 10;
	
	/**
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
	
	/**
	 * Pre-defined table columns
	 *
	 * @var array
	 */
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
				array('max_length', array(':value', 100)),
				array(array($this, 'unique'), array('title', ':value'))
			),
			'slug_title' => array(
				array('not_empty'),
				array('min_length', array(':value', 5)),
				array('max_length', array(':value', 100)),
				array(array($this, 'unique'), array('slug_title', ':value'))
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
	 * @param  array 	$values
	 * @param  Model_User $user
	 * @return boolean
	 * @throws ORM_Validation_Exception
	 */
	public function create_post(array $values, Model_User $user)
	{
		// Generate slug if present
		if ( ! empty($values['title']))
		{
			$this->slug_title = $this->generate_slug($values['title']);
		}
		
		$this->values($values, array(
			'title',
			'post_content',
			'language_id'
		));
		
		if ( ! $user->loaded())
		{
			throw new Exception('User is not properly set for creating code post');
		}
		
		$this->user = $user;
		$this->date_posted = time();
		
		return $this->create();
	}
	
	/**
	 * Updates the post
	 *
	 * @param  array	$values
	 * @param  Model_User $user
	 * @return boolean
	 * @throws ORM_Validation_Exception
	 */
	public function update_post(array $values, Model_User $user)
	{
		// Re-generate slug if present
		if ( ! empty($values['title']))
		{
			$this->slug_title = $this->generate_slug($values['title'], $this->id);
		}
		
		$this->values($values, array(
			'title',
			'post_content',
			'language_id'
		));
		
		if ( ! $user->loaded())
		{
			throw new Exception('User is not properly set for creating code post');
		}
		
		$this->user = $user;
		$this->date_modified = time();
		
		return $this->update();
	}
	
	/**
	 * Returns the absolute URL for viewing a code post
	 *
	 * @return string
	 * @throws Exception
	 * @uses   Route
	 */
	public function get_view_url()
	{
		if ( ! $this->loaded())
		{
			throw new Exception('Code model must be loaded first before it can generate urls');
		}
		
		return Route::url('view_code', array(
			'id' => $this->id,
			'slug' => $this->slug_title
		));
	}
	
	/**
	 * Returns the url for editing the code post
	 *
	 * @return string
	 * @throws Exception
	 * @uses   Route
	 */
	public function get_edit_url()
	{
		if ( ! $this->loaded())
		{
			throw new Exception('Code model must be loaded first before it can generate urls');
		}
		
		return Route::url('default', array(
			'controller' => 'post',
			'action' => 'edit',
			'id' => $this->id
		));
	}
	
	/**
	 * Returns true if the title already exists
	 *
	 * @param  string	$title
	 * @param  int		$exclude_id
	 * @return boolean
	 */
	public function title_exists($title, $exclude_id = NULL)
	{
		$code = new self;
		$code->where('title', '=', $title);
		
		if ($exclude_id)
		{
			$code->where('id', '<>', (int) $exclude_id);
		}
		
		$code->find();
		
		return $code->loaded();
	}
	
	/**
	 * Returns true if the slug exists
	 * When exclude id is present, it excludes the id from search
	 *
	 * @param  string	$slug
	 * @param  int		$exclude_id
	 * @return boolean
	 */
	public function slug_exists($slug, $exclude_id = NULL)
	{
		$code = new self;
		$code->where('slug_title', '=', $slug);
		
		if ($exclude_id)
		{
			$code->where('id', '<>', (int) $exclude_id);
		}
		
		$code->find();
		
		return $code->loaded();
	}
	
	/**
	 * Returns the last suffix for the slug pattern that uses
	 * numbers as suffix ex:
	 *
	 *     test-slug-2
	 *     test-slug-3
	 *
	 * When returns nothing, then this slug cannot be used anymore
	 * and must choose another slug
	 *
	 * Call this only when slug already exists
	 * 
	 * @param  string	$slug
	 * @param  int		$exclude_id
	 * @return int
	 */
	public function last_slug_suffix($slug, $exclude_id = NULL)
	{
		// Slug pattern is slug plus dash and number
		$pattern = $slug.'-%';
		
		// Assume that this slug is the second occurence
		// but check to ensure
		$suffix = 2;
		
		$code = new self;
		$code->where('slug_title', 'LIKE', $slug);
		
		if ($exclude_id)
		{
			$code->where('id', '<>', (int) $exclude_id);
		}
		
		$match = $code->order_by('slug_title', 'DESC')
			->limit(1)
			->find();
		
		if ($match->loaded())
		{
			$str = str_replace($slug.'-', '', $match->slug_title);
			
			if (is_numeric($str))
			{
				$suffix = (int) $str;
				$suffix++;
			}
		}
		
		return $suffix;
	}
	
	/**
	 * Generates a slug based on the title of the code post
	 * This also checks if the slug generated is unique and appends numbers
	 * to make it unique
	 *
	 * When exclude_id is present, it excludes that id from checking uniqueness
	 * since it is referring to itself
	 *
	 * @param  string	$title
	 * @param  int 		$exclude_id
	 * @return string
	 */
	public function generate_slug($title, $exclude_id = NULL)
	{
		// Limit slug to 97 chars to allow at most 3 digit number suffix
		$slug = Text::generate_slug(trim($title), 97);
		
		if ($this->slug_exists($slug, $exclude_id))
		{
			// If slug already exists, then append number suffix to make it unique
			$suffix = $this->last_slug_suffix($slug, $exclude_id);
			
			if ( ! $suffix)
			{
				throw new Exception('No suffix was generated for this slug');
			}
			
			$slug .= '-'.$suffix;
		}
		
		// God bless us if this is unique
		return $slug;
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

