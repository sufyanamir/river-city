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
        Schema::table('user_to_do_list', function (Blueprint $table) {
            if (!Schema::hasColumn('user_to_do_list', 'to_do_assigned_to')) {
                $table->text('to_do_assigned_to')->nullable();
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
        Schema::table('user_to_do_list', function (Blueprint $table) {
            if (Schema::hasColumn('user_to_do_list', 'to_do_assigned_to')) {
                $table->dropColumn('to_do_assigned_to');
            }
        });
    }
};
