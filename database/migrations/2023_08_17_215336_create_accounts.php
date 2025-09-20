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
        if (Schema::hasTable('accounts')) {
            return;
        }

        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->unique()->index();
            $table->boolean('active');
            $table->tinyInteger('status')->nullable();
            $table->ipAddress('reg_ip')->nullable();
            $table->string('reg_host')->nullable();
            $table->string('reg_domain')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
