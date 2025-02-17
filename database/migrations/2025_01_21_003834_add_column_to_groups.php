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
        Schema::table('groups', function (Blueprint $table) {
            if (!Schema::hasColumn('groups', 'show_group_total')) {
                $table->integer('show_group_total')->default(0);
            }
            if (!Schema::hasColumn('groups', 'include_est_total')) {
                $table->integer('include_est_total')->default(0);
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
        Schema::table('groups', function (Blueprint $table) {
            if (Schema::hasColumn('groups', 'show_group_total')) {
                $table->dropColumn('show_group_total');
            }
            if (Schema::hasColumn('groups', 'include_est_total')) {
                $table->dropColumn('include_est_total');
            }
        });
    }
};
