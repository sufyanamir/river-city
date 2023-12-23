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
        Schema::create('estimate_expenses', function(Blueprint $table){
            $table->id('estimate_expense_id');
            $table->integer('added_user_id');
            $table->integer('estimate_id');
            $table->timestamp('expense_date')->useCurrent();
            $table->text('expense_item_type');
            $table->text('expense_vendor')->nullable();
            $table->integer('labour_hours')->nullable();
            $table->double('expense_subtotal');
            $table->double('expense_tax')->nullable();
            $table->double('expense_total');
            $table->string('expense_paid')->default('not paid');
            $table->text('expense_description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('esimate_expenses');
    }
};
