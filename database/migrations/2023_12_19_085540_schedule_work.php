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
        Schema::create('schedule_work', function(Blueprint $table){
            $table->id('schedule_work_id');
            $table->integer('added_user_id');
            $table->integer('estimate_id');
            $table->integer('schedule_assigned')->default(0);
            $table->integer('schedule_assign_id');
            $table->timestamp('schedule_start_date')->useCurrent();
            $table->timestamp('schedule_end_date')->useCurrent();
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
        Schema::dropIfExists('schedule_work');
    }
};
