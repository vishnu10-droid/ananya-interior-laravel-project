<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('project_type')->nullable();
            $table->string('profession')->nullable();
            $table->string('city')->nullable();
            $table->string('area')->nullable();
            $table->string('pincode', 6)->nullable();
            $table->string('requirements')->nullable();
            $table->longText('message')->nullable();
            $table->enum('status', ['new', 'contacted', 'in_progress', 'converted', 'closed'])->default('new');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('follow_up_at')->nullable();
            $table->string('source')->default('contact');
            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index('follow_up_at');
            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
