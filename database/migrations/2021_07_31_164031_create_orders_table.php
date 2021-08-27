<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
    $table->unsignedBigInteger('customer_id');
    $table->string('name');
    $table->string('device');
    $table->datetime('order_call');
    $table->text('description');
    $table->text('alamat');
    $table->integer('cost_transport');
    $table->integer('down_payment')->nullable();
    $table->enum('status', array('menunggu', 'cancel', 'selesai'));
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
}
