<?php

use App\Models\Dictionaries\DictionaryColor;
use App\Models\User\User;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\Models\Section;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enote_notes', function (Blueprint $table) {
            $table->id();
            $table->ulid()->index();
            $table->foreignIdFor(Workspace::class)->index();
            $table->foreignIdFor(Section::class)->nullable()->index();
            $table->string('title')->nullable();
            $table->json('content')->nullable();
            $table->tinyInteger('type')->default(10);
            $table->double('sort')->default(65535);
            $table->foreignIdFor(DictionaryColor::class, 'color_id')->nullable();
            $table->foreignIdFor(User::class, 'created_by');
            $table->foreignIdFor(User::class, 'updated_by');
            $table->timestamps();
            $table->timestamp('updated_content_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enote_notes');
    }
};
