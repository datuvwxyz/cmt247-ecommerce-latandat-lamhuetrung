<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.pages.brand.listBrand');
    }

    public function add()
    {
        return view('admin.pages.brand.addBrand');
    }

    public function edit()
    {
        return view('admin.pages.brand.editBrand');
    }
}
