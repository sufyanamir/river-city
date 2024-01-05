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
        Schema::create('estimate_schedule', function(Blueprint $table){
            $table->id('estimate_schedule_id');
            $table->integer('added_user_id');
            $table->integer('estimate_id');
            $table->integer('estimate_complete_assigned_to');
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->nullable()->useCurrent();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('estimate_schedule');
    }
};
