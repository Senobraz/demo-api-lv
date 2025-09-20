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
        if (Schema::hasTable('account_settings')) {
            return;
        }

        Schema::create('account_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Account::class)->index();
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
