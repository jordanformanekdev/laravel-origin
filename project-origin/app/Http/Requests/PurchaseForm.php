<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Product;
use Stripe\{Charge, Customer, Source, Subscription};


class PurchaseForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stripeEmail' => 'required|email',
            'stripeToken' => 'required',
            'product' => 'required'
        ];
    }

    public function chargeUser()
    {
      $product = Product::findOrFail($this->product);

      $message = $this->user()->createUserCharge($product->price);

      return $message->outcome->seller_message;
    }

}
