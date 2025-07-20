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
        Schema::table('permissions', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned()->nullable()->after('guard_name');
            $table->boolean('is_parent')->unsigned()->nullable()->after('parent_id');
            $table->integer('position')->unsigned()->nullable()->after('is_parent');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn([
                'parent_id', 'is_parent', 'position',
            ]);
        });
    }
};
