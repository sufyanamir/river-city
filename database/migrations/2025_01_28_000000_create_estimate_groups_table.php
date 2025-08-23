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
        Schema::create('estimate_groups', function (Blueprint $table) {
            $table->id('estimate_group_id');
            $table->unsignedBigInteger('estimate_id');
            $table->string('group_name');
            $table->string('group_type')->default('assemblies');
            $table->text('group_description')->nullable();
            $table->boolean('show_unit_price')->default(true);
            $table->boolean('show_quantity')->default(true);
            $table->boolean('show_total')->default(true);
            $table->boolean('show_group_total')->default(true);
            $table->boolean('include_est_total')->default(true);
            $table->unsignedBigInteger('added_user_id');
            $table->timestamps();
            
            // Add foreign key constraint
            $table->foreign('estimate_id')->references('estimate_id')->on('estimates')->onDelete('cascade');
            $table->foreign('added_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimate_groups');
    }
};
