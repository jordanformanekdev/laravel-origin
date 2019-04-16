<?php

namespace Tests\Feature;

use App\Plan;
use App\StripeSubscription;
use App\StripeUser;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubscriptionTest extends TestCase
{
    use DatabaseTransactions;

    /** @test **/
    public function it_subscribes_a_user()
    {
        $token = \Stripe\Token::create([
          'card' => ['number' => '4242424242424242',
            'exp_month' => 1,
            'exp_year' => 2025,
            'cvc' => 123
          ]
        ])->id;

        $customerId = \Stripe\Customer::create([
          'email' => 'test@test.com',
          'source' => $token
        ])->id;

        $user = factory('App\User')->create();

        $stripeUser = factory('App\StripeUser')->create([
          'stripe_active' => 0,
          'stripe_id' => $customerId,
          'user_id' => $user->id
        ]);

        $subscription = new StripeSubscription($stripeUser->user);

        //Basic Plan
        $subscription->create(new Plan(['plan_id' => 'plan_EiBFYVFhMcnzDv']), $stripeUser->stripe_id);

        $stripeUser = $stripeUser->fresh();

        $this->assertTrue($stripeUser->isSubscribed());

    }
}
