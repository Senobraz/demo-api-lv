<?php

use App\Models\Account\Account;
use App\Models\Localizations\Language;
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
        if (Schema::hasTable('user_settings')) {
            return;
        }

        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->index();
            $table->foreignIdFor(Account::class)->index()->nullable();
            $table->foreignIdFor(Language::class);
            $table->string('timezone')->nullable();
            $table->string('date_format')->nullable();
            $table->string('time_format')->nullable();
            $table->tinyInteger('week_start')->nullable();
            $table->tinyInteger('appearance_mode')->nullable();
            $table->string('appearance_theme')->nullable();
            $table->string('appearance_color')->nullable();
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
        Schema::dropIfExists('account_settings');
    }
};
