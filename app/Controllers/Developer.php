<?php

namespace App\Controllers;

class Developer extends BaseController
{
    public function index(): string
    {
        $menu = getMenu();
        
        $data = [
			'title' => 'Welcome',
			'breadcrumb' => ['Developer','Welcome'],
			'stringmenu' => $menu, 
        ];
        return view('developer/v_welcome',$data);
    }

    public function form_pengajuan()
	{
        $menu = getMenu();
        
        $data = [
			'title' => 'Form Pengajuan',
			'breadcrumb' => ['Developer','Form Pengajuan'],
			'stringmenu' => $menu, 
			'validation' => \Config\Services::validation(), 
        ];
		return view('developer/form_pengajuan',$data);
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
