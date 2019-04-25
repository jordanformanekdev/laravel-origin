<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\StripeUser;
use App\StripeSubscription;
use Stripe\Customer;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'stripe_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projects()
    {
      return $this->hasMany(Project::class, 'owner_id');
    }

    public function details()
    {
      return response()->json(
        [
          'name' => $this->name,
          'email' => $this->email,
        ]
      );
    }

    public function createUserSubscription($plan, $token) {

      if (!$this->subscribed($plan->name)) {

        $variable = $this->newSubscription($plan->name, $plan->plan_id)->create($token);

        return 'Subscription Successful';

      } else {

        return 'Subscription Exists';

      }

    }

    public function createUserCharge($price) {

      try {

        $response = $this->charge($price);

      } catch (Exception $e) {

        return response()->json(
          ['status' => $e->getMessage()]
        );

      }

      return $response;

    }

}
