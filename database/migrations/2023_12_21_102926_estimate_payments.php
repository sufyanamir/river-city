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
        Schema::create('estimate_payments', function(Blueprint $table){
            $table->id('estimate_payment_id');
            $table->integer('added_user_id');
            $table->integer('estimate_id');
            $table->integer('estimate_complete_invoice_id');
            $table->timestamp('complete_invoice_date')->useCurrent();
            $table->double('invoice_total')->nullable();
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
        Schema::dropIfExists('estimate_payments');
    }
};
