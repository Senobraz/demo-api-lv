<?php

use App\Models\Account\Account;
use App\Models\Module\Module;
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
        if (Schema::hasTable('account_modules')) {
            return;
        }

        Schema::create('account_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Module::class)->index();
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
        Schema::dropIfExists('account_modules');
    }
};
