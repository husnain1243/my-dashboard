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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('status')->nullable();
            $table->string('featured_img')->nullable();
            $table->string('featured_img_alt')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('meta_tags')->nullable();
            $table->string('additional_tags')->nullable();
            $table->integer('views')->default(0);
            $table->string('comments_status')->nullable();
            $table->string('featured')->nullable();
            $table->string('is_category_feature')->nullable();
            $table->string('cat_main')->nullable();
            $table->string('category')->nullable();
            $table->string('author')->nullable();
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
        Schema::dropIfExists('blogs');
    }
};
