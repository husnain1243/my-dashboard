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
        Schema::create('all_sites', function (Blueprint $table) {
            $table->id();
            $table->string('sitename')->unique();
            $table->string('siteslug')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('meta_tags')->nullable();
            $table->longText('header_scripts')->nullable();
            $table->longText('site_header')->nullable();
            $table->longText('site_footer')->nullable();
            $table->longText('footer_scripts')->nullable();
            $table->longText('site_css')->nullable();
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
        Schema::dropIfExists('all_sites');
    }
};
