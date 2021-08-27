<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
  Schema::create('invoices', function (Blueprint $table) {
    $table->id();
    $table->text('invoice');
    $table->unsignedBigInteger('customer_id');
    $table->unsignedBigInteger('order_id');
    $table->unsignedBigInteger('product_id')->nullable();
    $table->string('name');
    $table->string('device');
    $table->datetime('order_call');
    $table->text('description');
    $table->text('alamat');
    $table->string('component')->nullable();
    $table->text('feedback_teknisi');
    $table->text('deskripsi_tindakan');
    $table->integer('harga_component');
    $table->integer('cost_transport');
    $table->integer('down_payment')->nullable();
    $table->integer('jasa_teknisi');
    $table->bigInteger('grand_total');
    $table->enum('status', array('pending', 'success', 'failed', 'expired'));
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
        Schema::dropIfExists('invoices');
    }
}
