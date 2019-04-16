<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Plan;

class PagesController extends Controller
{
    //
    public function home()
    {
      $products = Product::all();
      $plans = Plan::all();
      return view('welcome', compact('products', 'plans'));
    }

    public function about()
    {
      return view('about');
    }

    public function contact()
    {
      return view('contact');
    }
}
