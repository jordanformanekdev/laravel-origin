<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RegistrationForm;
use App\StripeUser;

class SubscriptionsController extends Controller
{

    public function store(RegistrationForm $form)
    {
      // subscription
      try {

        $stripeUser = $form->createStripeUser();

      } catch (\Exception $e) {

        return response()->json(

          ['status' => $e->getMessage()], 422

        );

      }

      return ['status' => 'Success'];
    }
}
