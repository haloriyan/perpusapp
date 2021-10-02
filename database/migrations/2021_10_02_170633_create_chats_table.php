<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('visitor_id')->unsigned()->index();
            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
            $table->bigInteger('interested_book')->unsigned()->index()->nullable();
            $table->foreign('interested_book')->references('id')->on('bukus')->onDelete('cascade');
            $table->string('sent_by', 55);
            $table->text('body');
            $table->text('processed_body')->nullable();
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
        Schema::dropIfExists('chats');
    }
}
