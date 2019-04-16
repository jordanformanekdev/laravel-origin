<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\StripeUser;
use App\StripeSubscription;
use Stripe\Customer;

class User extends Authenticatable
{
    use Notifiable;

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

    public function stripeUser()
    {
      return $this->hasOne(StripeUser::class, 'user_id');
    }

    public function subscription()
    {
      return new StripeSubscription($this);
    }

    public function setStripeId($stripe_id)
    {

      $this->update([
        'stripe_id' => $stripe_id
      ]);
    }

    public function createStripeUser()
    {
      $customer = Customer::create([
        'email' => $this->email,
        'source' => $this->stripeToken,
      ]);

      $this->setStripeId($customer->id);

      $stripeUser = $this->stripeUser()->create([
        'user_id' => $this->id,
        'stripe_id' => $customer->id
      ]);

      return $stripeUser;
    }

}
