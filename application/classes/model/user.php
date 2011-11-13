<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * CMC User model
 *
 */
class Model_User extends Model_Auth_User {
	
	/**
	 * Manually defined table columns
	 *
	 * @var array
	 */
	protected $_table_columns = array(
		'id' => array(),
		'email' => array(),
		'username' => array(),
		'password' => array(),
		'logins' => array(),
		'last_login' => array(),
		'date_registered' => array()
	);
	
	/** 
	 * Automatically insert creation date when creating users
	 *
	 * @var  array
	 */
	protected $_created_column = array(
		'column' => 'date_registered',
		'format' => TRUE,
	);

	/**
	 * @var Auth
	 */
	protected $_auth;
	
	/**
	 * Returns auth instance
	 *
	 * @return Auth
	 */
	public function get_auth()
	{
		if ($this->_auth === NULL)
		{
			$this->_auth = Auth::instance();
		}
		
		return $this->_auth;
	}
	
	/**
	 * Sets the auth instance
	 *
	 * @param  Auth		$auth
	 * @return Model_User
	 */
	public function set_auth(Auth $auth)
	{
		$this->_auth = $auth;
		
		return $this;
	}
	
	/**
	 * Rules for user model
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			'username' => array(
				array('not_empty'),
				array('max_length', array(':value', 32)),
				array('regex', array(':value', '/^[a-zA-Z0-9_]++$/')),
				array(array($this, 'unique'), array('username', ':value')),
			),
			'password' => array(
				array('not_empty'),
			),
			'email' => array(
				array('not_empty'),
				array('email'),
				array(array($this, 'unique'), array('email', ':value')),
			),
		);
	}	
	
	/**
	 * Filters field values before inserting/updating to database
	 *
	 * @return array
	 */
	public function filters()
	{
		$auth = $this->get_auth();
		
		return array(
			'username' => array(
				array('trim')
			),
			'password' => array(
				array(array($auth, 'hash'))
			)
		);
	}
	
	/**
	 * Create login role for the current user
	 *
	 * @return boolean
	 */
	public function create_login_role()
	{
		$role = ORM::factory('role', array('name' => 'login'));
		
		if ($role->loaded() && $this->loaded())
		{
			$role->add('users', $this);
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	/**
	 * Returns user's profile url
	 *
	 * @return string
	 */
	public function get_profile_url()
	{
		return '/profile/'.$this->username;
	}

	/** 
	 * Search users via passed criteria
	 *
	 * Parameter keys
	 *    date_registered
	 *    date_registered_start
	 *    date_registered_end
	 *    username
	 *    email
	 *
	 * @param   array	$params
	 * @return  array
	 */
	public function custom_search(array $params, $limit)
	{
		$orm = ORM::factory('user');

		// Date parameters
		if ( ! empty($params['date_registered']))
		{
			// Create date range for a day from 12:00 am to 11:59:59 pm
			$range = Date::get_day_range($params['date_registered']);

			if (is_array($range) && count($range) === 2)
			{
				$orm->where('date_registered', 'BETWEEN', DB::expr(implode(' AND ', $range)));
			}
		}
		elseif ( ! empty($params['date_registered_start']) && ! empty($params['date_registered_end']))
		{
			$start = NULL;
			$end = NULL;

			// Start date starts at 12:00 am
			if (Date::is_valid_format($params['date_registered_start'], 'Y-m-d'))
			{
				$start = strtotime($params['date_registered_start'].' 00:00:00');
			}

			// End date ends in 11:59:59 pm
			if (Date::is_valid_format($params['date_registered_end'], 'Y-m-d'))
			{
				$end = strtotime($params['date_registered_end'].' 23:59:59');
			}

			// Start date should always be lesser than end date
			if ($start && $end && $start < $end)
			{
				$orm->where('date_registered', 'BETWEEN', DB::expr($start.' AND '.$end));
			}
		}

		// Username parameter
		if (isset($params['username']) && strlen($params['username']) >= 5)
		{
			$orm->where('username', 'LIKE', $params['username']);
		}

		// Email parameter
		if (isset($params['email']) && strlen($params['email']) >= 5)
		{
			$orm->where('email', 'LIKE', $params['email']);
		}

		$result = $orm->limit($limit)->find_all();
		
		// Consolidate and format result
		$ret = array();

		foreach ($result as $row)
		{
			$tmp = $row->as_array();
			// Format last login and date registered
			$tmp['pretty_last_login'] = date('Y-m-d H:i:s', $tmp['last_login']);
			$tmp['pretty_date_registered'] = date('Y-m-d H:i:s', $tmp['date_registered']);
			// Fuzzy span
			$tmp['fuzzy_last_login'] = Date::extra_fuzzy_span($tmp['last_login']);
			$tmp['fuzzy_date_registered'] = Date::extra_fuzzy_span($tmp['date_registered']);

			$ret[] = $tmp;
		}

		return $ret;
	}
}
