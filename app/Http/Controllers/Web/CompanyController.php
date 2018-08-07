<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index()
    {
        $data = [];
        return view('web.company', $data);
    }
}
