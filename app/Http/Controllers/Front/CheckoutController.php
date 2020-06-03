<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\GeniusMailer;
use App\Models\Product;
use App\Models\PaymentGateway;
use App\Models\Currency;
use Session;
use Auth;

class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function checkout($id)
    {
        if (!Session::has('product_id')) {
            return view('errors.404');
        }
        else {
            if($id != Session::get('product_id')){
            return view('errors.404');                
            }
        }
    	$product = Product::findOrFail($id);
        return view('front.checkout',compact('product'));
    }
}
