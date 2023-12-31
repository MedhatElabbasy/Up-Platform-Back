<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('method');
            $table->string('type')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->tinyInteger('module_status')->default(0);
            $table->text('logo')->nullable();
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });


        DB::table('payment_methods')->insert([
            [
                'method' => 'Tap',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => 'public/demo/gateway/tap.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'method' => 'PayPal',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => 'public/demo/gateway/paypal.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'method' => 'Stripe',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => 'public/demo/gateway/stripe.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'method' => 'PayStack',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 0,
                'logo' => 'public/demo/gateway/paystack.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'method' => 'RazorPay',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 0,
                'logo' => 'public/demo/gateway/razorpay.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'method' => 'PayTM',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 0,
                'logo' => 'public/demo/gateway/paytm.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'method' => 'Bank Payment',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'method' => 'Offline Payment',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'method' => 'Wallet',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}
