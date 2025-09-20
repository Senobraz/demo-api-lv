<?php

use App\Models\Dictionaries\DictionaryColor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('dictionary_colors') && !Schema::hasColumn('dictionary_colors', 'ulid')) {
            Schema::table('dictionary_colors', function (Blueprint $table) {
                $table->ulid()->index()->after('id');
            });

            foreach (DictionaryColor::all() as $model) {
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
        if (Schema::hasColumn('dictionary_colors', 'ulid')) {
            Schema::table('dictionary_colors', function (Blueprint $table) {
                $table->dropColumn('ulid');
            });
        }
    }
};
