<?php

use App\Models\Dictionaries\DictionaryIcon;
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
        if (Schema::hasTable('dictionary_icons') && !Schema::hasColumn('dictionary_icons', 'ulid')) {
            Schema::table('dictionary_icons', function (Blueprint $table) {
                $table->ulid()->index()->after('id');
            });

            foreach (DictionaryIcon::all() as $model) {
                if(!$model->ulid) {
                    $model->ulid = strtolower((string)Str::ulid());
                    $model->save();
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('dictionary_icons', 'ulid')) {
            Schema::table('dictionary_icons', function (Blueprint $table) {
                $table->dropColumn('ulid');
            });
        }
    }
};
