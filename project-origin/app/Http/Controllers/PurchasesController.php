<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe\{Charge, Customer};
use App\Product;

class PurchasesController extends Controller
{

    public function store()
    {
      $product = Product::findOrFail(request('product'));

      $customer = Customer::create([
        'email' => request('stripeEmail'),
        'source' => request('stripeToken')
      ]);

      $charge = Charge::create([
        'customer' => $customer->id,
        'amount' => $product->price,
        'currency' => 'usd'
      ]);

      return 'All Done';
    }
}
