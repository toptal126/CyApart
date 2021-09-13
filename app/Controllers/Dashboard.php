<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
  protected $session;

  public function __construct()
  {
	  $this->session = \Config\Services::session();
  }

	public function index()
	{
		if (!$this->session->get('user')){
			return redirect()->to("/login");
		}
		$data = [
			'title' => 'Starter Project CodeIgniter 4'
		];

		return view('dashboard/index', $data);
	}
}