<?php

use App\Models\Dictionaries\DictionaryColor;
use App\Models\Dictionaries\DictionaryIcon;
use App\Models\User\User;
use App\Models\Workspace\Workspace;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enote_sections', function (Blueprint $table) {
            $table->id();
            $table->ulid()->index();
            $table->foreignIdFor(Workspace::class)->index();
            $table->bigInteger('parent_id')->index()->nullable()->unsigned();
            $table->integer('level')->nullable()->default(0);
            $table->string('external_code')->nullable();
            $table->tinyInteger('type')->default(10);
            $table->tinyInteger('status')->default(10);
            $table->string('name');
            $table->text('description')->nullable();
            $table->double('sort')->default(65535);
            $table->foreignIdFor(DictionaryColor::class, 'color_id')->nullable();
            $table->foreignIdFor(DictionaryIcon::class, 'icon_id')->nullable();
            $table->bigInteger('file_id')->nullable()->unsigned();
            $table->foreignIdFor(User::class, 'created_by');
            $table->foreignIdFor(User::class, 'updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enote_sections');
    }
};
