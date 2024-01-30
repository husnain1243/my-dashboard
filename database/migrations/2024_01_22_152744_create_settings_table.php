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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('site_name')->nullable();
            $table->text('title')->nullable();
            $table->text('header_scripts')->nullable();
            $table->text('footer_scripts')->nullable();
            $table->longText('nav_html')->nullable();
            $table->longText('nav_css')->nullable();
            $table->longText('nav_project_data')->nullable();
            $table->longText('footer_html')->nullable();
            $table->json('extras')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
