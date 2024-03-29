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
        Schema::table('estimate_item_template_items', function (Blueprint $table) {
            $table->double('labour_expense')->nullable();
            $table->double('material_expense')->nullable();
            $table->double('item_cost')->nullable();
            $table->double('item_price')->nullable();
            $table->text('item_description')->nullable();
            $table->text('item_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimate_item_template_items');
    }
};
