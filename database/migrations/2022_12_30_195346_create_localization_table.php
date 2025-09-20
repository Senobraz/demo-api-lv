<?php

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
        if (!Schema::hasTable('localizations')) {
            Schema::create('localizations', function (Blueprint $table) {
                $table->id();
                $table->string('code');
                $table->string('package');
                $table->text('ru')->nullable();
                $table->text('en')->nullable();
                $table->double('sort')->default(65535);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('localizations');
    }
};
