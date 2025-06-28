<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;


class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }
}
