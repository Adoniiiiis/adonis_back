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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('author');
            $table->integer('book_id')->nullable();
            $table->string('tag_page')->nullable();
            $table->string('tag_time')->nullable();
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('quote')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
