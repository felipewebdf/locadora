<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index()
    {
        return view('web.index', ['title' => 'Página inicial']);
    }

}
