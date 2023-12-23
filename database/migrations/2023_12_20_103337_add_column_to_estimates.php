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
        Schema::table('estimates', function (Blueprint $table) {
            $table->integer('schedule_assigned')->default(0);
            $table->integer('schedule_assigned_to')->nullable();
            $table->integer('work_completed_by')->nullable();
            $table->timestamp('complete_work_date')->useCurrent();
            $table->integer('invoice_assigned')->default(0);
            $table->integer('invoice_assigned_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimates');
    }
};
