<?php

namespace App\Controllers;

class Unauthorized extends BaseController
{
    public function index(): string
    {
        return view('errors/html/error_403');
    }



}
