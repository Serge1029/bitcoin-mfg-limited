<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function planChoose()
    {
        $products = Product::orderBy('id','desc')->get();
        return view('user.plan.index',compact('products'));
    }
}
