<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriPdfTable extends Migration
{
    public function up()
    {
        Schema::create('materi_pdf', function (Blueprint $table) {
            $table->bigIncrements('id_materi');
            $table->string('judul_materi');
            $table->string('filename'); // nama file pdf yang di-upload
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materi_pdf');
    }
}
    