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
        Schema::create('estimate_items', function(Blueprint $table){
            $table->id('estimate_item_id');
            $table->integer('added_user_id');
            $table->integer('estimate_id');
            $table->integer('item_id')->nullable();
            $table->string('item_name');
            $table->string('item_type');
            $table->string('item_unit')->nullable();
            $table->float('item_cost')->nullable();
            $table->float('item_price');
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
        Schema::dropIfExists('estimate_items');
    }
};
