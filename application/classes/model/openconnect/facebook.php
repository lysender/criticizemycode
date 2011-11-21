<?php defined('SYSPATH') or die('No direct script access.');

class Model_Openconnect_Facebook {
	
	const STATUS_NO_AUTH = 'no_auth';
	const STATUS_USER_DECLINED = 'user_declined';
	const STATUS_USER_REGISTERED = 'user_registered';
	const STATUS_USER_NOT_REGISTERED = 'user_not_registered';
	const STATUS_ERROR = 'error';

	public $facebook;

	protected $_profile;

	protected $_user;

	protected $_openconnect;

	protected $_status;

	public function __construct()
	{
		// Configure Facebook library
		if ( ! class_exists('Facebook'))
		{
			include Kohana::find_file('vendor', 'facebook/src/facebook');
		}

		$config = Kohana::$config->load('facebook');

		$this->facebook = new Facebook(array(
			'appId' => $config['app_id'],
			'secret' => $config['secret'],
			'cookie' => $config['cookie']
		));

		$this->_status = self::STATUS_NO_AUTH;
	}

	public function get_status()
	{
		return $this->_status;
	}

	/** 
	 * Initializes authentication by visiting facebook page and
	 * let the user authenticate our app
	 *
	 * @param   Request	$request
	 * @return  void
	 * @uses    Request::redirect
	 */
	public function start_auth(Request $request)
	{
		$login_url = $this->facebook->getLoginUrl(array(
			'scope' => 'email'
		));

		$request->redirect($login_url);
	}

	public function process_auth_response(Request $request)
	{
		if ($identifier = $this->facebook->getUser())
		{
			// Check if the user is already registered in the system
			$user = $this->get_user($identifier);

			if ($user)
			{
				// User is already registered
				$this->_status = self::STATUS_USER_REGISTERED;
			}
			else
			{
				// Retrieve user's facebook profile
				$profile = $this->get_profile();

				if ( ! empty($profile))
				{
					$this->_status = self::STATUS_USER_NOT_REGISTERED;
				}
				else
				{
					$this->_status = self::STATUS_NO_AUTH;
				}
			}
		}
		else
		{
			// Check if there was an error returned in the facebook request
			$error = $request->query('error');

			if ($error == 'access_denied')
			{
				$this->_status = self::STATUS_USER_DECLINED;
			}
			elseif ($error)
			{
				$this->_status = self::STATUS_ERROR;
			}
			else
			{
				$this->_status = self::STATUS_NO_AUTH;
			}
		}

		return $this->_status;
	}

	public function get_identifier()
	{
		return $this->facebook->getUser();
	}

	/** 
	 * Returns the user's facebook profile by callin
	 * facebook api
	 *
	 * @return  array
	 */
	public function get_profile()
	{
		if ($this->_profile === NULL)
		{
			$user = $this->facebook->getUser();

			if ($user)
			{
				try
				{
					$this->_profile = $this->facebook->api('/me');
				}
				catch (FacebookApiException $e)
				{
					$this->_profile = NULL;
				}
			}
		}
		
		return $this->_profile;
	}

	/** 
	 * Returns the user based on the facebook's unique identifier
	 * for the currently logged in user
	 *
	 * @param   int		$identifier
	 * @return  Model_User
	 */
	public function get_user($identifier = NULL)
	{
		if ($identifier === NULL)
		{
			$identifier = $this->facebook->getUser();
		}

		if ($this->_user === NULL)
		{
			$orm = ORM::factory('openconnect', array(
				'third_party_name' => 'facebook',
				'third_party_identifier' => $identifier
			));

			if ($orm->loaded())
			{
				$user = ORM::factory('user', $orm->user_id);

				if ($user->loaded())
				{
					$this->_user = $user;
				}
			}
		}

		return $this->_user;
	}

	public function get_email()
	{
		$profile = $this->get_profile();
		$email = NULL;

		if ( ! empty($profile['email']))
		{
			$email = $profile['email'];
		}

		return $email;
	}

	public function get_suggested_username()
	{
		$email = $this->get_email();
		$username = NULL;

		if ($email)
		{
			$chunks = explode('@', $email);

			if ( ! empty($chunks[0]))
			{
				$username = preg_replace('/[^0-9a-zA-Z-_]/', '', $chunks[0]);
			}
		}

		return $username;
	}

	/** 
	 * Creates a new user from the facebook data
	 *
	 * @param   string	$username
	 * @return  boolean
	 */
	public function create_user($username)
	{
		$user = ORM::factory('user');
		$dummy_password = uniqid(microtime(), TRUE);
		$data = array(
			'username' => $username,
			'email' => $this->get_email(),
			'password' => $dummy_password,
			'password_confirm' => $dummy_password,
		);

		$user->create_user($data, array('username', 'email', 'password'));
		
		if ( ! $user->loaded())
		{
			throw new Exception('User is not properly loaded during signup');
		}
		
		// Create login role for this user
		if ( ! $user->create_login_role())
		{
			throw new Exception('User has not been granted with login role during signup');
		}
		
		// Create open connect for facebook
		$orm = ORM::factory('openconnect');
		$orm->user_id = $user->id;
		$orm->third_party_name = 'facebook';
		$orm->third_party_identifier = $this->get_identifier();
		$orm->create();

		if ( ! $orm->loaded())
		{
			throw new Exception('User has not been granted with open connect login');
		}

		return TRUE;
	}
}