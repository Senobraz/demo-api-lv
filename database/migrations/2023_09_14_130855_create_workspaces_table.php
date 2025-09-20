<?php

use App\Models\Dictionaries\DictionaryColor;
use App\Models\Dictionaries\DictionaryIcon;
use App\Models\Module\Module;
use App\Models\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workspaces', function (Blueprint $table) {
            $table->id();
            $table->ulid()->index();
            $table->string('external_code')->nullable();
            $table->foreignIdFor(User::class, 'owner_id')->index();
            $table->foreignIdFor(Module::class)->index();
            $table->tinyInteger('type')->default(10);
            $table->tinyInteger('status')->default(10);
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignIdFor(DictionaryColor::class, 'avatar_color_id')->nullable();
            $table->foreignIdFor(DictionaryIcon::class, 'avatar_icon_id')->nullable();
            $table->bigInteger('avatar_file_id')->nullable();
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
        Schema::dropIfExists('workspaces');
    }
};
