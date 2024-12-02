<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function welcome(): string
    {
        return view('pengajuan/v_mon_ro');
    }
}
