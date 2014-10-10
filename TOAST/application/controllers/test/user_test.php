<?php

require_once(APPPATH . '/controllers/test/Toast.php');
require_once(APPPATH . '/controllers/user.php'); //Require the tested class's file

class user_test extends Toast
{
	private $UserController;

	function __construct()
	{
		parent::__construct(__FILE__);
		$this->UserController = new User(true);	//Instantiate class
	}

	function _pre() {

		//Prepare unit test user database entry

		$data = array (
			'user_id' => '987654321',
			'username' => 'unit_test_username',
			'password' => 'unit_test_password'
			'name' => 'Test',
			'address' => 'Test Address',
			'city' => 'Test',
			'state' => 'TE',
			'zip_code' => '23456',
		);

		echo $this->db->insert('users', $data);
	}

	function test_login()
	{
		$this->_assert_true($this->UserController->user_model->login('unit_test_user_pre', 'unit_test_password'));
	}

	function _post() {

		//Remove unit test office from database
		$this->db->delete('users', array('user_id' => '987654321')); 
	}
}

?>