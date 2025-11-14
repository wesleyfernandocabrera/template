<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('site')->nullable();
        $table->string('name')->nullable();
        $table->string('archive')->nullable(); // PDF
        $table->string('archive_name')->nullable();
        $table->string('companie_name')->nullable();
        $table->string('companie_description')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
