<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Plan;
use Stripe\{Charge, Customer, Source, Subscription};


class RegistrationForm extends FormRequest
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
            'plan' => 'required'
        ];
    }

    public function createStripeUser()
    {
      $plan = Plan::findOrFail($this->plan);
      var_dump($plan->plan_id);

      $stripeUser = $this->user()->createStripeUser();
      var_dump($stripeUser->stripe_id);
      $this->user()
          ->subscription()
          ->create($plan, $stripeUser->stripe_id);

      return $stripeUser;
    }

}
