<?php

namespace App\Http\Controllers;

class CreateAccountController extends Controller
{
    public function index()
    {
        return view('auth.create-account');
    }
}
