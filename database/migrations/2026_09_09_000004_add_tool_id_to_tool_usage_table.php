<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tool_usage', function (Blueprint $table) {
            $table->foreignId('tool_id')->nullable()->after('id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('tool_usage', function (Blueprint $table) {
            $table->dropForeign(['tool_id']);
            $table->dropColumn('tool_id');
        });
    }
};
