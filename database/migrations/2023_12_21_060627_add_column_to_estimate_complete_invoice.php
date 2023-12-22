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
        Schema::table('estimate_complete_invoice', function (Blueprint $table) {
            $table->timestamp('complete_invoice_date')->useCurrent();
            $table->string('invoice_name')->nullable();
            $table->float('tax_rate')->nullable();
            $table->double('invoice_total')->nullable();
            $table->double('invoice_due')->nullable();
            $table->string('invoice_status')->default('unpaid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimate_complete_invoice');
    }
};
