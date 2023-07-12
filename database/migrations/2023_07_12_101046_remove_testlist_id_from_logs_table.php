<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('logs', function (Blueprint $table) {
            //
            $table->dropForeign('logs_testlist_id_foreign');
            $table->dropColumn('testlist_id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logs', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('testlist_id')->nullable();
            $table->foreign('testlist_id')->references('id')->on('testlists')->onDelete('set null');
        });
    }
};
