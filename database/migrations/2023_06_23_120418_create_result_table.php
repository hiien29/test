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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('testlist_id')->constrained('testlists');
            $table->string('result')->nullable()->default('未実施');
            $table->string('tester')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result');
    }
};
