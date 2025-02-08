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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->date('date')->nullable();
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('cover_photo')->nullable();
            $table->timestamps(); // creates `created_at` and `updated_at` columns
            $table->string('full_name')->nullable();
        });
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->integer('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('title');
            $table->string('description_image')->nullable();
            $table->text('content');
            $table->string('media_url')->nullable();
            $table->integer('like_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->timestamps();
        });
        Schema::create('comments', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->integer('post_id')->constrained()->onDelete('cascade');
            $table->integer('user_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->timestamps();
        });
        Schema::create('categories', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('notifications', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->integer('user_id')->constrained('users')->onDelete('cascade');
            $table->text('content');
            $table->integer('noti_type')->constrained('notification_types')->onDelete('cascade');
            $table->string('direct_url')->nullable();
            $table->timestamps();
        });
        Schema::create('notification_types', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('notification_types');

    }
};
