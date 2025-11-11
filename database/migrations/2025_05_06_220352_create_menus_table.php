<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ex: tecnologia, rh, etc.
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('menu_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->primary(['user_id', 'menu_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_user');
        Schema::dropIfExists('menus');
   }
};
