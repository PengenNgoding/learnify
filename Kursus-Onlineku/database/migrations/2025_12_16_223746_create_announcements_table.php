<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('announcements', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('judul');
        $table->text('isi');
        $table->dateTime('tanggal_mulai')->nullable();
        $table->dateTime('tanggal_selesai')->nullable();
        $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('announcements');
    }
}
