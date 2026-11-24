<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /* Two "after application" showcase cards on /products/{category}. */
        Schema::table('categories', function (Blueprint $table) {
            $table->string('look_one_image')->nullable()->after('note');
            $table->string('look_one_caption')->nullable()->after('look_one_image');
            $table->string('look_two_image')->nullable()->after('look_one_caption');
            $table->string('look_two_caption')->nullable()->after('look_two_image');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['look_one_image', 'look_one_caption', 'look_two_image', 'look_two_caption']);
        });
    }
};
