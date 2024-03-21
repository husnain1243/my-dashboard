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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('siteslug')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('category')->nullable();
            $table->string('status')->nullable();
            $table->text('meta_desc')->nullable();
            $table->text('meta_tags')->nullable();
            $table->longText('html')->nullable();
            $table->longText('css')->nullable();
            $table->longText('project_data')->nullable();
            $table->text('header_scripts')->nullable();
            $table->text('footer_scripts')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
