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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('status')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('featured_img')->nullable();
            $table->string('featured_img_alt')->nullable();
            $table->string('category')->nullable();
            $table->string('author')->nullable();
            $table->text('meta_desc')->nullable();
            $table->text('meta_tags')->nullable();
            $table->longText('additional_tags')->nullable();
            $table->longText('summernote')->nullable();
            $table->longText('header_scripts')->nullable();
            $table->longText('footer_scripts')->nullable();
            $table->json('extras')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
