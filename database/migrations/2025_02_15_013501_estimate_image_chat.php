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
        Schema::create('estimate_image_chat', function (Blueprint $table) {
            $table->id('estimate_image_chat_id');
            $table->unsignedBigInteger('estimate_image_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_name');
            $table->text('message');
            $table->text('mentioned_users')->nullable();
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
        Schema::dropIfExists('estimate_image_chat');
    }
};
