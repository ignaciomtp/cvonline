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
        Schema::create('default_template_settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('template_id')->constrained();
            $table->float('base_font_size');
            $table->float('base_line_height');
            $table->float('name_size');
            $table->float('name_line_height')->nullable();
            $table->float('job_size');
            $table->float('job_line_height')->nullable();
            $table->float('section_size')->nullable();
            $table->float('sidebar_section_size')->nullable();
            $table->float('sidebar_font_size')->nullable();
            $table->float('sidebar_line_height')->nullable();
            $table->float('address_size')->nullable();
            $table->float('address_line_height')->nullable();
            $table->float('section_separation')->nullable();
            $table->float('photo_height')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_template_settings');
    }
};
