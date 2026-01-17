<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            // ini harus SAMA tipe dengan users.user_id
            $table->string('user_id', 48);

            // INI YANG PENTING: sama kayak materi.id_materi (bigIncrements)
            $table->unsignedBigInteger('id_materi');

            $table->string('tipe')->default('akses_video');
            $table->boolean('is_free')->default(true);
            $table->string('status')->default('sukses');
            $table->integer('jumlah')->default(0);

            $table->timestamps();

            // foreign key
            $table->foreign('user_id')
                  ->references('user_id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_materi')
                  ->references('id_materi')->on('materi')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
