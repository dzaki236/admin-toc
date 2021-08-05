<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('order_id');
            $table->enum('hardware', array('laptop', 'komputer','printer','lainnya'));
            $table->string('description');
            $table->integer('dp');
            $table->string('pickup_address');
            $table->dateTime('pickup_datetime', $precision = 0);
            $table->unsignedBigInteger('teknisi_id');
            $table->string('feedback_teknisi');
            $table->enum('admin_approval',array('yes','no','pending'));
            $table->enum('customer_confirmation',array('yes','no','pending'));
            $table->string('customer_message');
            $table->integer('fullpay');
            $table->enum('status',array('execute','deliver','finish'));
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
        Schema::dropIfExists('repairs');
    }
}
