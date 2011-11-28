<?php defined('SYSPATH') or die('No direct script access.');

class Model_Openconnect_Twitter {
	
	const REQUEST_TOKEN_URL = 'https://api.twitter.com/oauth/request_token';
	const AUTHORIZE_URL = 'https://api.twitter.com/oauth/authorize';
	const ACCESS_TOKEN_URL = 'https://api.twitter.com/oauth/access_token';
	const OAUTH_VERSION = '1.0';

	const STATUS_NO_AUTH = 'no_auth';
	const STATUS_USER_DECLINED = 'user_declined';
	const STATUS_USER_REGISTERED = 'user_registered';
	const STATUS_USER_NOT_REGISTERED = 'user_not_registered';
	const STATUS_ERROR = 'error';

	public $twitterauth;

	protected $_session;
	protected $_request;

	protected $_status;
	protected $_user;
	protected $_access_token;
	protected $_profile;

	public function __construct(Request $request, Session $session)
	{
		// Configure Facebook library
		if ( ! class_exists('TwitterOAuth'))
		{
			include Kohana::find_file('vendor', 'twitter/twitteroauth/twitteroauth');
		}

		$config = Kohana::$config->load('twitter');

		$this->_request = $request;
		$this->_session = $session;

		$token = $this->_session->get_once('oauth_token');
		$token_secret = $this->_session->get_once('oauth_token_secret');

		if ( ! $token && ! $token_secret)
		{
			$access_token = $this->_session->get('oauth_access_token');

			if ($access_token)
			{
				$token = $access_token['oauth_token'];
				$token_secret = $access_token['oauth_token_secret'];

				$this->_access_token = $access_token;
			}
		}

		// The TwitterOAuth instance  
		if ($token && $token_secret)
		{
			$this->twitteroauth = new TwitterOAuth(
				$config->consumer_key, 
				$config->consumer_secret, 
				$token, 
				$token_secret
			);
		}
		else
		{
			$this->twitteroauth = new TwitterOAuth(
				$config->consumer_key, 
				$config->consumer_secret
			);
		}

		// Set status
		$this->_status = self::STATUS_NO_AUTH;
	}

	public function start_auth()
	{
		// Clear previous oauth session data
		$this->_session->delete('oauth_access_token')
			->delete('oauth_access_token_secret')
			->delete('oauth_user_id')
			->delete('oauth_screen_name');

		// Requesting authentication tokens, the parameter is the URL we will be redirected to  
		$request_token = $this->twitteroauth->getRequestToken();

		if ( ! isset($request_token['oauth_token']))
		{
			throw new Exception('Unable to get request token from twitter');
		}

		// Saving them into the session  
		$this->_session->set('oauth_token', $request_token['oauth_token']);
		$this->_session->set('oauth_token_secret', $request_token['oauth_token_secret']);

		// If everything goes well..  
		if($this->twitteroauth->http_code == 200)
		{
			// Let's generate the URL and redirect  
			$url = $this->twitteroauth->getAuthorizeURL($request_token['oauth_token']); 
			$this->_request->redirect($url);
		}
		else
		{ 
			// It's a bad idea to kill the script, but we've got to know when there's an error.  
			throw new Exception('Unable to get twitter authorization');
		}
	}

	public function process_callback()
	{
		if ($this->_request->query('denied'))
		{
			$this->_status = self::STATUS_USER_DECLINED;
			return FALSE;
		}

		$v = $this->_request->query('oauth_verifier');

		if ( ! $v)
		{
			$this->_status = self::STATUS_ERROR;
			return FALSE;
		}

		$access_token = $this->twitteroauth->getAccessToken($v);

		if ( ! isset($access_token['user_id']))
		{
			$this->_status = self::STATUS_ERROR;
			return FALSE;
		}

		if ($access_token && isset($access_token['screen_name']) && isset($access_token['user_id']))
		{
			$this->_session->set('oauth_access_token', $access_token['oauth_token']);
			$this->_session->set('oauth_access_token_secret', $access_token['oauth_token_secret']);
			$this->_session->set('oauth_user_id', $access_token['user_id']);
			$this->_session->set('oauth_screen_name', $access_token['screen_name']);

			$this->user_id = $access_token['user_id'];
			$this->screen_name = $access_token['screen_name'];

			$orm = $this->get_user($this->user_id);

			if ($orm && $orm->loaded())
			{
				$this->_status = self::STATUS_USER_REGISTERED;
			}
			else
			{
				$this->_status = self::STATUS_USER_NOT_REGISTERED;
			}

			return TRUE;
		}
		else
		{
			$this->_status = self::STATUS_ERROR;
		}

		return FALSE;
	}

	public function get_profile()
	{
		$token = $this->_session->get('oauth_access_token');
		$token_secret = $this->_session->set('oauth_access_token_secret');
		$this->user_id = $this->_session->get('oauth_user_id');
		$this->screen_name = $this->_session->set('oauth_screen_name');

		if ($this->user_id && $this->screen_name)
		{
			return array(
				'user_id' => $this->user_id,
				'screen_name' => $this->screen_name
			);
		}
		elseif ($token && $token_secret)
		{
			$access_token = $this->twitteroauth->getAccessToken();
			var_dump($access_token);
		}

		return FALSE;
	}

	public function get_status()
	{
		return $this->_status;
	}

	public function get_identifier()
	{
		return $this->user_id;
	}

	public function get_user($identifier = NULL)
	{
		if ($identifier === NULL)
		{
			$identifier = $this->user_id;
		}

		if ($this->_user === NULL && $identifier)
		{
			$orm = ORM::factory('openconnect', array(
				'third_party_name' => 'twitter',
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
}