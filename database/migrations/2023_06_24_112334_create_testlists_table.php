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
        Schema::create('testlists', function (Blueprint $table) {
            $table->id();
            $table->date('make_day');
            $table->date('test_day');
            $table->integer('age');
            $table->string('type');
            $table->string('site',20);
            $table->string('result')->nullable();
            $table->string('author',20);
            $table->string('editor',20)->nullable();
            $table->string('tester')->nullable();
            $table->string('test_editor')->nullable();
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testlists');
    }
};
