<?php

namespace App\Controllers;

use App\Models\UserModel;


class User extends BaseController
{
 	protected $userModel;
  protected $session;

  public function __construct()
  {
    $this->userModel = new UserModel();
	  $this->session = \Config\Services::session();
	  $this->session->start();
  }
	public function index()
	{
		return redirect()->to('/login');
	}
	public function logout(){
		$this->session->remove('user');
		return redirect()->to('/login'); 
	}
	public function login()
	{
		return view('auth/login');
	}
	public function check_login(){
		$email = $this->request->getPost("email");
		$password = $this->request->getPost("password");

		$result = $this->userModel->attemptLogin($email, $password);
		if ($result['type'] == 0){
			$this->session->setFlashdata('error', $result['message']);
			return redirect()->back();
		}

		$this->session->set("user", $result["user"]);
		return redirect()->to('/dashboard');
	}
}
