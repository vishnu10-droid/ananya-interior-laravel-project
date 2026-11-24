<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /* Extra content pulled from the old static front-end so the admin can
           manage everything that the public pages actually render. */
        Schema::table('categories', function (Blueprint $table) {
            $table->string('group')->nullable()->after('sort_order');
            $table->json('features')->nullable()->after('brands');
            $table->json('applications')->nullable()->after('features');
            $table->json('variants')->nullable()->after('applications');
            $table->unsignedSmallInteger('pdf_page')->nullable()->after('icon');
            $table->boolean('featured')->default(false)->after('status');
            $table->string('tag')->nullable()->after('featured');
            $table->string('note')->nullable()->after('tag');
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->boolean('featured')->default(false)->after('status');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->json('highlights')->nullable()->after('description');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('date')->nullable()->after('designation');
        });

        Schema::table('media', function (Blueprint $table) {
            $table->string('title')->nullable()->after('alt_text');
            $table->string('category')->nullable()->after('title');
            $table->json('meta')->nullable()->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['group', 'features', 'applications', 'variants', 'pdf_page', 'featured', 'tag', 'note']);
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('featured');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('highlights');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('date');
        });

        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn(['title', 'category', 'meta']);
        });
    }
};
