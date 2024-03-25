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
        Schema::create('estimates', function(Blueprint $table){
            $table->id('estimate_id');
            $table->integer('customer_id');
            $table->integer('added_user_id');
            $table->string('customer_name');
            $table->text('customer_phone');
            $table->text('customer_address');
            $table->integer('edited_by')->nullable();
            $table->string('estimate_status')->default('pending');
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
        Schema::dropIfExists('estimates');
    }
};
