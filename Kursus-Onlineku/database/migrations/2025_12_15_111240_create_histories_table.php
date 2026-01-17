<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_materi');
            $table->enum('tipe', ['video', 'pdf']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
