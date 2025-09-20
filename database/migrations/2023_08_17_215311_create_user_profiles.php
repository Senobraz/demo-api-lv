<?php

use App\Models\Dictionaries\DictionaryIcon;
use App\Models\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('user_profiles')) {
            return;
        }

        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->index();
            $table->char('avatar_color', 7)->nullable();
            $table->char('avatar_default_color', 7)->nullable();
            $table->foreignIdFor(DictionaryIcon::class, 'avatar_icon_id')->nullable();
            $table->char('avatar_icon_color', 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
};
