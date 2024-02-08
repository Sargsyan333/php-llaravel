<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminWebController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
}
