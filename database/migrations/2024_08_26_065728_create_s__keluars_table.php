<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s__keluars', function (Blueprint $table) {
            $table->id();
            $table->string('kode_obat_keluar')->default('DEFAULT_KODE');
            $table->date('tanggal_keluar');
            $table->biginteger('obat_id')->unsigned();
                    //foreign
                    $table->foreign('obat_id')
                    ->references('id')
                    ->on('obats');
            $table->integer('qty');
            $table->biginteger('user_id')->unsigned();
                    //foreign
                    $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
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
        Schema::dropIfExists('s__keluars');
    }
}
