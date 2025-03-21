<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.pages.category.listCategory');
    }

    public function add()
    {
        return view('admin.pages.category.addCategory');
    }

    public function edit()
    {
        return view('admin.pages.category.editCategory');
    }
}
