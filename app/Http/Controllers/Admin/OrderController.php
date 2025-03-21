<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.pages.order.listOrder');
    }

    public function add()
    {
        return view('admin.pages.order.addOrder');
    }

    public function edit()
    {
        return view('admin.pages.order.editOrder');
    }
}
