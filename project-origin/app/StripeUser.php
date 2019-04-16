<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Stripe\{Charge, Customer, Source};
use App\StripeSubscription;

class StripeUser extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'stripe_id', 'stripe_active', 'subscription_end_at', 'stripe_subscription'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public static function byStripeId($stripeId)
  {
    return static::where('stripe_id', $stripeId)->firstOrFail();
  }

  public function isSubscribed()
  {
    return !! $this->stripe_active;
  }

  public function activate($subscriptionId)
  {
    $this->update([
      'stripe_active' => true,
      'subscription_end_at' => null,
      'stripe_subscription' => $subscriptionId
    ]);

  }

  public function deactivate()
  {
    $this->update([
      'stripe_active' => false,
      'subscription_end_at' => \Carbon\Carbon::now()
    ]);
  }

  public function subscription()
  {

    return new StripeSubscription;
  }


}
