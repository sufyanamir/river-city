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
        Schema::table('estimate_item_assemblies', function (Blueprint $table) {
            $table->integer('item_id');
            $table->double('ass_item_cost')->nullable();
            $table->double('ass_item_price')->nullable();
            $table->double('ass_item_qty')->nullable();
            $table->double('ass_item_total')->nullable();
            $table->text('ass_item_unit')->nullable();
            $table->text('ass_item_description')->nullable();
            $table->string('ass_item_type')->nullable();
            $table->double('ass_labour_expense')->nullable();
            $table->double('ass_material_expense')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimate_item_assemblies');
    }
};
