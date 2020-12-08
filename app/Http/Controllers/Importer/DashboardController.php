<?php

namespace App\Http\Controllers\Importer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('importer.dashboard');
    }
}
