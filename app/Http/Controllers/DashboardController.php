<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $productCount = Product::count();
    $categoryCount = Category::count();

    return view('dashboard', compact('productCount', 'categoryCount'));
}
}
