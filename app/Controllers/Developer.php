<?php

namespace App\Controllers;

class Developer extends BaseController
{
    public function index(): string
    {
        return view('developer/v_welcome');
    }
}
