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
        Schema::table('estimate_proposals', function (Blueprint $table) {
            $table->integer('view_count')->default(0);
            $table->timestamp('last_viewed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estimate_proposals', function (Blueprint $table) {
            $table->dropIfExists('estimate_proposals');
        });
    }
};
