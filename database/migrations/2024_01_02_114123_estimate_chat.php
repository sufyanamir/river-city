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
        Schema::create('estimate_chat', function(Blueprint $table){
            $table->id('estimate_chat_id');
            $table->integer('estimate_id');
            $table->integer('added_user_id');
            $table->text('chat_message')->nullable();
            $table->text('chat_image')->nullable();
            $table->text('chat_emojis')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimate_chat');
    }
};
