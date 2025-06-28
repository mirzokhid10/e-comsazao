<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VendorController extends Controller
{

    public function dashboard()
    {
        return view('vendor.dashboard.dashboard');
    }
}
