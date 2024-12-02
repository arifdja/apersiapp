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
        return view('developer/v_welcome');
    }

    public function form_register()
	{
        $menu = "";
        
        $data = [
			'title' => 'Register',
			'breadcrumb' => ['Home','Profil'],
			'stringmenu' => $menu, 
			'validation' => \Config\Services::validation(), 
        ];
		return view('user/form_register',$data);
    }
}
