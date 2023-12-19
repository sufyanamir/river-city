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
        Schema::create('complete_estimates', function(Blueprint $table){
            $table->id('complete_estimate_id');
            $table->integer('added_user_id');
            $table->integer('estimate_id');
            $table->integer('estimate_completed_by');
            $table->integer('estimate_assigned_to_accept');
            $table->timestamp('acceptence_start_date')->useCurrent();
            $table->timestamp('acceptence_end_date')->useCurrent();
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
        Schema::dropIfExists('complete_estimates');
    }
};
