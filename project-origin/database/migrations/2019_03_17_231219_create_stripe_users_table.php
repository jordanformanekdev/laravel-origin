<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('stripe_users', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->string('stripe_id')->nullable();
          $table->boolean('stripe_active')->default(false);
          $table->timestamp('subscription_end_at')->nullable();
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stripe_users');
    }
}
