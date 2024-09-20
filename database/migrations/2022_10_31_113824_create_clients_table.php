<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('email',100);
            $table->string('phone',100)->nullable();
            $table->longText('address')->nullable();
            $table->string('id_card_image')->nullable();
            $table->string('payment_method',100);
            $table->string('payment_full_name',100);
            $table->string('payment_email',100);
            $table->string('payment_direct_phone_number',100)->nullable();
            $table->string('payment_direct_account_number',100)->nullable();
            $table->string('payment_direct_routing_number',100)->nullable();
            $table->string('payment_direct_account_type',100)->nullable();
            $table->string('payment_direct_bank_name',100)->nullable();
            $table->boolean('disclaimer')->nullable();
            $table->string('client_status')->nullable();
            $table->integer('total_amount')->nullable();
            $table->integer('po_number')->nullable();
            $table->string('signature');
            // $table->unsignedBigInteger('product_id')->nullable()->unsigned();
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            

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
        Schema::dropIfExists('clients');
    }
};
