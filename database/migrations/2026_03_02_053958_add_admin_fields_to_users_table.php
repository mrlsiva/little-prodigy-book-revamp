<?php

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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user'])->default('user')->after('password');
            $table->boolean('is_active')->default(true)->after('role');
            $table->string('username')->unique()->nullable()->after('email');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
            $table->unsignedBigInteger('created_by')->nullable()->after('last_login_at');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'is_active', 'username', 'last_login_at', 'created_by', 'updated_by']);
        });
    }
};
