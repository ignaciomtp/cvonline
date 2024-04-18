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
        Schema::create('custom_item_resume', function (Blueprint $table) {
            $table->foreignId('custom_item_id')->constrained();
            $table->foreignUuid('resume_id')->references('id')->on('resumes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_item_resume');
    }
};
