<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\PTModel;
use App\Models\PengajuanModel;
use App\Models\PengajuanDetailModel;
use App\Models\DashboardModel;
use App\Models\PendanaModel;

class Pendana extends BaseController
{
    public function __construct()
    {
        $access = ['pendana'];
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
			'breadcrumb' => ['Developer','Welcome'],
			'stringmenu' => $menu, 
        ];
        return view('v_welcome',$data);
    }
    
    public function list_developer()
    {
		$menu = getMenu();
        $userModel = new UserModel();
        $developer = $userModel->getDeveloper2();
        dd($developer);
        
        $data = [
			'title' => 'Monitoring Pengajuan Dana',
			'breadcrumb' => ['Monitoring','Pengajuan Dana'],
			'stringmenu' => $menu, 
            'result' => $developer
        ];

        return view('operator/list_developer', $data);
    }



}
