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
			'breadcrumb' => ['Pendana','Welcome'],
			'stringmenu' => $menu, 
        ];
        return view('v_welcome',$data);
    }
    
    public function list_developer()
    {
		$menu = getMenu();
        $userModel = new UserModel();
        $developer = $userModel->getDeveloperByPendana();
        // dd($developer);
        
        $data = [
			'title' => 'Monitoring Pengajuan Dana',
			'breadcrumb' => ['Monitoring','Pengajuan Dana'],
			'stringmenu' => $menu, 
            'result' => $developer
        ];

        return view('operator/list_developer', $data);
    }

    
    public function developer()
    {
		$menu = getMenu();
        $model = new UserModel();
        $developer = $model->getDeveloperByPendana();

        $data = [
			'title' => 'Developer',
			'breadcrumb' => ['Data','Developer'],
			'stringmenu' => $menu, 
            'result' => $developer,
        ];
        return view('operator/p_pendaftaran_developer',$data);
    }

    public function pt()
	{
		$menu = getMenu();
        $model = new PTModel();
        $pt = $model->getPTByPendana();

        $data = [
			'title' => 'PT',
			'breadcrumb' => ['Data','PT'],
			'stringmenu' => $menu, 
            'result' => $pt,
        ];
        return view('operator/p_pendaftaran_pt',$data);
	}
    
    public function permintaan_dana()
    {
       
		$menu = getMenu();
        $model = new PengajuanModel();
        $dana = $model->getPengajuanDana();

        // dd($dana);

        $data = [
			'title' => 'Persetujuan Pengajuan Dana',
			'breadcrumb' => ['Persetujuan','Pengajuan Dana'],
			'stringmenu' => $menu, 
            'result' => $dana,
        ];
        return view('operator/u_pengajuan_dana',$data);
    }

    
    public function approval_unit()
	{
        $uuid = $this->request->getGet('uuid');

		$menu = getMenu();
        $model = new PengajuanDetailModel();
        $unit = $model->getPengajuanUnit($uuid);

        $data = [
			'title' => 'Persetujuan Pengajuan Unit',
			'breadcrumb' => ['Persetujuan','Pengajuan Unit'],
			'stringmenu' => $menu, 
            'result' => $unit
        ];
        return view('operator/p_pengajuan_unit',$data);
	}



}
