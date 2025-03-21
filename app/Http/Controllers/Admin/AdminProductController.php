<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminProductController extends Controller
{
    public function index()
    {
        return view('admin.pages.product.listProduct');
    }

    public function add()
    {
        return view('admin.pages.product.addProduct');
    }

    public function edit()
    {
        return view('admin.pages.product.editProduct');
    }
}
