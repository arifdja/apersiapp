<?php

namespace App\Controllers;

class Developer extends BaseController
{

    public function __construct()
    {
        $access = ['developer'];
		if (!in_array(session('kdgrpuser'),$access)) {
			echo view('errors/html/error_403');
			die();
		}
    }

    public function index(): string
    {
        $menu = getMenu();
        $data = [
			'stringmenu' => $menu, 
        ];
        return view('v_welcome',$data);
    }

    public function form_pengajuan_pt()
	{
        $menu = getMenu();
        
        $data = [
			'title' => 'Form Pengajuan',
			'breadcrumb' => ['Developer','Form Pengajuan PT'],
			'stringmenu' => $menu, 
			'validation' => \Config\Services::validation(), 
        ];
		return view('developer/form_pengajuan_pt',$data);
    }

    public function form_pengajuan_dana()
	{
        $menu = getMenu();
        
        $data = [
			'title' => 'Form Pengajuan',
			'breadcrumb' => ['Developer','Form Pengajuan Dana'],
			'stringmenu' => $menu, 
			'validation' => \Config\Services::validation(), 
        ];
		return view('developer/form_pengajuan_dana',$data);
    }

    public function dashboard()
	{
		$menu = getMenu();

        $data = [
			'title' => 'Dashboard',
			'breadcrumb' => ['Developer','Dashboard'],
			'stringmenu' => $menu, 
        ];
        return view('developer/v_dashboard',$data);
	}



}
