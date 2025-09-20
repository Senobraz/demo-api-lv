<?php

use App\Models\User\User;
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
        Schema::create('enote_collaborative_notes', function (Blueprint $table) {
            $table->id();
            $table->ulid()->index();
            $table->boolean('active');
            $table->boolean('public_active');
            $table->ulid('public_key')->index()->nullable();
            $table->string('public_code')->nullable();
            $table->string('public_url')->nullable();
            $table->timestamp('public_date')->nullable();
            $table->tinyInteger('type')->default(10);
            $table->tinyInteger('accept')->default(10);
            $table->foreignIdFor(\App\Modules\Enotes\Models\Note::class)->index();
            $table->foreignIdFor(User::class, 'owner_id')->index();
            $table->foreignIdFor(User::class, 'supplier_id');
            $table->foreignIdFor(User::class, 'author_id');
            $table->integer('share_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->double('sort')->default(65535);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enote_collaborative_notes');
    }
};
