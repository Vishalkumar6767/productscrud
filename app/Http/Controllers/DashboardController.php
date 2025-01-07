<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $productCount = Product::withoutTrashed()->count();
        $categoryCount = Category::count();
        return view('dashboard', compact('productCount', 'categoryCount'));
    }
}
