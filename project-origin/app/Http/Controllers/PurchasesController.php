<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PurchaseForm;


class PurchasesController extends Controller
{

    public function store(PurchaseForm $form)
    {
      // subscription
      try {

        $message = $form->chargeUser();

      } catch (\Exception $e) {

        return response()->json(

          ['status' => $e->getMessage()], 422

        );

      }

      return ['status' => $message];
    }
}
