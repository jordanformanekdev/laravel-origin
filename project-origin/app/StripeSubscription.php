<?php

namespace App;

use Stripe\Subscription;
use App\User;

class StripeSubscription
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'customer', 'items'
  ];

  protected $guarded = [];

  protected $user;

  public function __construct(User $user)
  {
    $this->user = $user;
  }

  public function create(Plan $plan, $customerId)
  {

    $subscription = Subscription::create([
      'customer' => $customerId,
      'items' => [
        [
          'plan' => $plan->plan_id
        ],
      ]
    ]);

    $check = $this->user->stripeUser->activate($subscription->id);

  }
}
