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
        if (Schema::hasTable('enote_notes')) {
            Schema::table('enote_notes', function (Blueprint $table) {
                $table->json('preview')->nullable()->after('heading');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('enote_notes', 'preview')) {
            Schema::table('enote_notes', function (Blueprint $table) {
                $table->dropColumn('preview');
            });
        }
    }
};
