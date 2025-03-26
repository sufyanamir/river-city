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
        Schema::create('company_branches', function(Blueprint $table){
            $table->id('branch_id');
            $table->integer('company_id');
            $table->string('branch_name');
            $table->string('branch_address');
            $table->string('branch_city')->nullable();
            $table->string('branch_state')->nullable();
            $table->string('branch_zip_code')->nullable();
            $table->string('branch_email')->nullable();
            $table->string('branch_phone')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_branches');
    }
};
