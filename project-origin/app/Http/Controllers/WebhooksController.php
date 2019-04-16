<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\StripeUser;


class WebhooksController extends Controller
{  
    public function handle()
    {
      $payload = request()->all();

      $method = $this->eventToMethod($payload['type']);

      if (method_exists($this, $method)) {
        $this->$method($payload);
      }

      response('Webhook Received');

    }

    public function whenCustomerSubscriptionDeleted($payload)
    {
      $stripeUser = StripeUser::byStripeId($payload['data']['object']['customer']);

      $stripeUser->deactivate();
    }

    public function eventToMethod($event)
    {
      return 'when' . studly_case(str_replace('.', '_', $event));
    }

}
