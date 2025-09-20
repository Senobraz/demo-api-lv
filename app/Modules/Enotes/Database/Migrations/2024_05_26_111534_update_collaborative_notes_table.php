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
        Schema::table('enote_collaborative_notes', function (Blueprint $table) {
            $table->ulid('note_ulid')->after('note_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enote_collaborative_notes', function (Blueprint $table) {
            $table->boolean('note_ulid');
        });
    }
};
