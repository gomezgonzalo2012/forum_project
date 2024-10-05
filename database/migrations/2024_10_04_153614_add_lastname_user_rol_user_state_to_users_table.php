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
            $table->string("lastname")->after("name");
            $table->string("user_rol")->nullable(false)->default("user");
            $table->string("user_state")->default("active");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("lastname");
            $table->dropColumn("user_rol");
            $table->dropColumn("user_state");
        });
    }
};
