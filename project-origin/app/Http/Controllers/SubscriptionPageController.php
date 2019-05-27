<?php

namespace App\Http\Controllers;

use App\Project;
use App\Product;
use App\Plan;
use Illuminate\Http\Request;

class SubscriptionPageController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $user = auth()->user();

      $products = Product::all();

      $plans = Plan::all();

      $profileImage = $user->profileImages()->latest()->first();

      return view('user.subscription.subscription', compact('user', 'products', 'plans'));
    }
}
