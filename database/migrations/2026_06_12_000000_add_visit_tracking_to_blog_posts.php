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
        // Add view_count to blog_posts table
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('view_count')->default(0)->after('read_time');
        });

        // Create blog_post_views table to track individual visits
        Schema::create('blog_post_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_post_id');
            $table->string('ip_address');
            $table->string('user_agent')->nullable();
            $table->timestamps();

            $table->foreign('blog_post_id')->references('id')->on('blog_posts')->onDelete('cascade');
            $table->index('blog_post_id');
            $table->index('ip_address');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_post_views');
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('view_count');
        });
    }
};
