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
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('teknisi_id');
            $table->text('feedback_teknisi');
            $table->text('deskripsi_tindakan');
            $table->integer('jasa_teknisi');
            $table->integer('total_component')->nullable();
            $table->enum('approval_customer', array('menunggu', 'cancel', 'pengerjaan'));
            $table->enum('status', array('menunggu', 'cancel', 'finish'));
            $table->text('message');
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
