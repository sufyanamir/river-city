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
        Schema::create('estimate_item_assemblies', function(Blueprint $table){
            $table->id('estimate_item_assembly_id');
            $table->integer('added_user_id');
            $table->integer('estimate_id');
            $table->integer('estimate_item_id');
            $table->text('est_ass_item_name')->nullable();
            $table->double('item_unit_by_ass_unit')->nullable();
            $table->double('ass_unit_by_item_unit')->nullable();
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
        Schema::dropIfExists('estimate_item_assemblies');
    }
};
