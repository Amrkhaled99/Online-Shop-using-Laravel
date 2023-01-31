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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("fname",50);
            $table->string("lname",50);
            $table->string("mobile",30);
            $table->string("email",80);
            $table->string("address1",80);
            $table->string("address2",80);
            $table->string("country",20);
            $table->string("city",20);
            $table->string("state",20);
            $table->string("zip",10);
            $table->float('sub_total');
            $table->float('shipping');
            $table->float('total');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
};
