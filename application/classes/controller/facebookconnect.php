<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Facebookconnect extends Controller_Site {
	
	public $auto_render = FALSE;

	public function action_index()
	{
		var_dump($_GET);
	}

	public function action_connect()
	{
		// Build login/auth url
		$url = 'https://www.facebook.com/dialog/oauth?client_id=%s&redirect_uri=%s&scope=email';
		$config = Kohana::$config->load('facebook');
		$land = URL::site('/facebookconnect', TRUE);

		$fburl = sprintf($url, $config['app_id'], urlencode($land));
		var_dump($fburl);
	}

	public function action_getemail()
	{
		// Build url
		$url = 'https://graph.facebook.com/oauth/access_token?client_id=%s&redirect_uri=%s&client_secret=%s&code=%s';
		$config = Kohana::$config->load('facebook');
		$land = URL::site('/facebookconnect', TRUE);
		$code = 'AQCn-4nxRnsR7wY1ozc-8rrP3C3bnjFUXm0FXk62DWrqVAVlsjb4qWyZ8kdJa_1HjzMzcJHwcDisFYCnY3ylUp3FtmHcM9P8bb4BF4t_hyI_bOf8EVrQlg_jDsI9iRtITSdG7A6YezuD-oO6qLCA9Hyg7iCx2arltx69L6ZfTyCAxlmMrXN7Q72Vp0BFUjte9hQ';
		
		$fburl = sprintf($url, $config['app_id'], urlencode($land), $config['app_secret'], $code);
		var_dump($fburl);
	}
}