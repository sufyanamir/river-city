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
        Schema::create('estimate_emails', function(Blueprint $table){
            $table->id('estimate_email_id');
            $table->integer('added_user_id');
            $table->integer('estimate_id');
            $table->integer('email_id');
            $table->string('email_name');
            $table->text('email_to');
            $table->text('email_subject')->nullable();
            $table->text('email_body');
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
        Schema::dropIfExists('estimate_emails');
    }
};
