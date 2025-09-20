<?php

use App\Models\Dictionaries\DictionaryColor;
use App\Models\Dictionaries\DictionaryIcon;
use App\Models\Module\Module;
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
        if (Schema::hasTable('user_workspaces')) {
            return;
        }

        Schema::create('user_workspaces', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->index();
            $table->foreignIdFor(Workspace::class)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_workspaces');
    }
};
