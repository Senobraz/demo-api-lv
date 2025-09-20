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
        Schema::create('enote_report_notes', function (Blueprint $table) {
            $table->id();
            $table->ulid()->index();
            $table->foreignIdFor(\App\Modules\Enotes\Models\Note::class)->index();
            $table->tinyInteger('type')->default(10);
            $table->ipAddress('ip')->nullable();
            $table->text('text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enote_report_notes');
    }
};
