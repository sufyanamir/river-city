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
        Schema::create('estimate_item_template_items', function(Blueprint $table){
            $table->id('est_template_item_id');
            $table->integer('added_user_id');
            $table->integer('estimate_id');
            $table->integer('est_template_id');
            $table->integer('item_id');
            $table->integer('item_qty')->nullable();
            $table->double('item_total')->nullable();
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
        //
    }
};
