<?php

use App\Models\Account\Account;
use App\Models\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('support_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->ulid()->index();
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->tinyInteger('type')->default(10);
            $table->string('smile')->nullable();
            $table->foreignIdFor(User::class, 'user_id')->index();
            $table->foreignIdFor(Account::class)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_feedbacks');
    }
};
