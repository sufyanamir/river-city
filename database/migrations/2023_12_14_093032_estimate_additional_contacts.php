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
        Schema::create('estimate_contacts', function(Blueprint $table){
            $table->id('contact_id');
            $table->integer('added_user_id');
            $table->integer('estimate_id');
            $table->text('contact_title');
            $table->string('contact_first_name');
            $table->string('contact_last_name')->nullable();
            $table->text('contact_email');
            $table->text('contact_phone');
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
        Schema::dropIfExists('estimate_contacts');
    }
};
