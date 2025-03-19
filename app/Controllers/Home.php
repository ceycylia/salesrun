<?php

namespace App\Controllers;
use App\Models\Pipeline;

class Home extends BaseController
{
    public function index()
    {

 

        $pages = [
            'title' => 'Home'
        ];
        // return view('welcome_message');
        $props = compact('pages');
        return view('pages/home/index', $props);
    }
}
