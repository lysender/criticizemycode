<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Site
{
	/**
	 * Front page
	 */
	public function action_index()
	{
		$this->template->title = 'Dashboard';
		$this->view = View::factory('index/index');
		
		//$auth = Auth::instance();
		//$auth->logout();
		//$result = $auth->login('dc.eros@gmail.com', 'password', TRUE);
		//var_dump($result);
		
		//$user = ORM::factory('user');
		//$role = ORM::factory('role');
		//$token = ORM::factory('user_token');
		
		//$user->where('email', '=', 'dc.eros@gmail.com')
		//	->find();
		//	
		//if ($user->loaded())
		//{
		//	$role->where('name', '=', 'login')->find();
		//	
		//	if ($role->loaded()) {
		//		$role->add('users', $user);
		//	}
		//}
		
		//$role->add('users', $user);
		
		//try
		//{
		//	$user->create_user(array(
		//			'username' => 'root',
		//			'email' => 'dc.eros@gmail.com',
		//			'password' => 'password',
		//			'password_confirm' => 'password'
		//		),
		//		array(
		//			'username',
		//			'email',
		//			'password'
		//		)
		//	);
		//}
		//catch (ORM_Validation_Exception $e)
		//{
		//	var_dump($e->errors('signup'));
		//}
		//var_dump($_SESSION, $_COOKIE);
		//var_dump($auth->get_user());
	}
}
