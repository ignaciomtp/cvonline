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
            $table->string('role')->default('user');
            $table->string('surname')->nullable();
            $table->string('phone')->nullable();
            $table->string('job')->nullable();
            $table->string('address')->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->string('photo')->nullable();
            $table->string('web')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('surname');
            $table->dropColumn('phone');
            $table->dropColumn('job');
            $table->dropColumn('zip');
            $table->dropColumn('city');
            $table->dropColumn('province');
            $table->dropColumn('country');
            $table->dropColumn('photo');
            $table->dropColumn('address');
            $table->dropColumn('web');
        });
    }
};
