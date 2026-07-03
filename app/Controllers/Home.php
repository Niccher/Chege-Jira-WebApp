<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (auth()->loggedIn()) {
            return redirect()->to('/home');
        }

        return redirect()->to('/auth/login');
    }
}
