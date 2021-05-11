<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	public function index()
	{
		#models views
		$usersModel = new \App\Models\UsersModel();
		$loggedUserId = session()->get('loggedUser');
		$userInfo = $usersModel->find($loggedUserId);
		$data = [
			'title' => 'Dashboard',
			'userInfo' => $userInfo
		];
		return view('dashboard/index', $data); #pasar parametros a la vista mediante consulta 
	}
	function profile(){
		#models views
		$usersModel = new \App\Models\UsersModel();
		$loggedUserId = session()->get('loggedUser');
		$userInfo = $usersModel->find($loggedUserId);
		$data = [
			'title' => 'Profile',
			'userInfo' => $userInfo
		];
		return view('dashboard/profile', $data); #pasar parametros a la vista mediante consulta 
	}
}
