<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_service', function (Blueprint $table) {
            $table->id();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->string('judul');
            $table->longText('paragraf_awal');
            $table->longText('paragraf_akhir');
            $table->integer('flag_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_service');
    }
}
