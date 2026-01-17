<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_announcement_reads_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementReadsTable extends Migration
{
    public function up()
    {
        Schema::create('announcement_reads', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('announcement_id');
            $table->string('user_id', 48); // sesuai users.user_id

            $table->timestamps();

            $table->foreign('announcement_id')
                  ->references('id')->on('announcements')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('user_id')->on('users')
                  ->onDelete('cascade');

            $table->unique(['announcement_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcement_reads');
    }
}
