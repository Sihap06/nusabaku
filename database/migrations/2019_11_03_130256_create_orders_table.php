<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->string('nama_lengkap');
            $table->string('harga');
            $table->string('nama_produk');
            $table->string('qty');
            $table->string('telepon');
            $table->string('email');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('alamat');
            $table->string('kode_pos');
            $table->string('kurir');
            $table->string('cost');
            $table->enum('status', ['order', 'booked']);
            $table->string('bukti_tf')->nullable();
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
