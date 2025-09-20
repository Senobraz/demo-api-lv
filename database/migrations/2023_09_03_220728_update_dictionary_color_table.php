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
        if (!Schema::hasTable('dictionary_colors') || Schema::hasColumn('dictionary_colors', 'alt_value')) {
            return;
        }

        Schema::table('dictionary_colors', function (Blueprint $table) {
            $table->string('alt_value')->nullable()->after('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('dictionary_colors', 'alt_value')) {
            Schema::table('dictionary_colors', function (Blueprint $table) {
                $table->dropColumn('alt_value');
            });
        }
    }
};
