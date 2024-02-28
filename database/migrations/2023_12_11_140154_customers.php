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
        Schema::create('customers', function(Blueprint $table){
            $table->id('customer_id');
            $table->integer('added_user_id');
            $table->string('customer_first_name');
            $table->string('customer_last_name')->nullable();
            $table->text('customer_email');
            $table->text('customer_phone');
            $table->text('customer_company_name')->nullable();
            $table->text('customer_project_name')->nullable();
            $table->bigInteger('customer_project_number')->nullable();
            $table->text('customer_primary_address');
            $table->text('customer_secondary_address')->nullable();
            $table->text('customer_city');
            $table->text('customer_state');
            $table->bigInteger('customer_zip_code');
            $table->float('tax_rate')->nullable();
            $table->text('potential_value')->nullable();
            $table->text('company_internal_note')->nullable();
            $table->text('source')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
