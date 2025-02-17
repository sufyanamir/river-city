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
        Schema::table('estimates', function (Blueprint $table) {
            if (!Schema::hasColumn('estimates', 'percentage_discount')) {
                $table->float('percentage_discount')->nullable();
            }
            if (!Schema::hasColumn('estimates', 'price_discount')) {
                $table->float('price_discount')->nullable();
            }
            if (!Schema::hasColumn('estimates', 'discounted_total')) {
                $table->double('discounted_total')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estimates', function (Blueprint $table) {
            if (Schema::hasColumn('estimates', 'percentage_discount')) {
                $table->dropColumn('percentage_discount');
            }
            if (Schema::hasColumn('estimates', 'price_discount')) {
                $table->dropColumn('price_discount');
            }
            if (Schema::hasColumn('estimates', 'discounted_total')) {
                $table->dropColumn('discounted_total');
            }
        });
    }
};
