<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('dictionary_colors')) {
            Schema::create('dictionary_colors', function (Blueprint $table) {
                $table->id();
                $table->string('label');
                $table->string('value');
                $table->string('package')->index();
                $table->double('sort')->default(65535);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('dictionary_colors');
    }
};
