<?php

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
        if (Schema::hasTable('modules')) {
            return;
        }

        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20);
            $table->boolean('active')->default(true);
            $table->string('name');
            $table->double('sort')->default(65535);
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
        Schema::dropIfExists('modules');
    }
};
