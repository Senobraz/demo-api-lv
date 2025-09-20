<?php

use App\Models\Account\Account;
use App\Models\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('user_accounts')) {
            return;
        }

        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->index();
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
        Schema::dropIfExists('user_accounts');
    }
};
