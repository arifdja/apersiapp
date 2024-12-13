<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\PTModel;
use App\Models\PengajuanModel;
use App\Models\PengajuanDetailModel;
use App\Models\DashboardModel;

class Approver extends BaseController
{
    public function __construct()
    {
        $access = ['approver'];
		if (!in_array(session('kdgrpuser'),$access)) {
			echo view('errors/html/error_403');
			die();
		}
    }

    public function index(): string
    {
        $menu = getMenu();
        
        $data = [
			'title' => 'Welcome',
			'breadcrumb' => ['Approver','Welcome'],
			'stringmenu' => $menu, 
        ];
        return view('v_welcome',$data);
    }

    public function dashboard()
	{
		$menu = getMenu();

        $data = [
			'title' => 'Dashboard',
			'breadcrumb' => ['Approver','Dashboard'],
			'stringmenu' => $menu, 
        ];
        return view('approver/v_dashboard',$data);
	}

    
    public function list_developer()
    {
		$menu = getMenu();
        $userModel = new UserModel();
        $developer = $userModel->getDeveloper();
        
        $data = [
			'title' => 'Daftar Developer',
			'breadcrumb' => ['Persetujuan','Pengajuan Dana'],
			'stringmenu' => $menu, 
            'result' => $developer
        ];

        return view('approver/list_developer', $data);
    }



}
