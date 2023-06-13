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
        Schema::create('stok_ins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('id')->on('produks');
            $table->unsignedBigInteger('satuan_id');
            $table->foreign('satuan_id')->references('id')->on('satuans');
            $table->unsignedBigInteger('tempat_id');
            $table->foreign('tempat_id')->references('id')->on('tempats');
            $table->integer('harga_beli')->nullable();
            $table->date('tgl_beli', 20)->nullable();
            $table->integer('jml_produk')->nullable();
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
        Schema::dropIfExists('stok_ins');
    }
};
