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
    Schema::create('movies', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('description');
      $table->foreignId('language_id')->constrained('languages', 'id');
      $table->integer('duration');
      $table->integer('year');
      $table->bigInteger('votes')->nullable();
      $table->enum('section', ['general', 'novedades', 'tendencias', 'aclamadas'])->default('general');
      $table->string('image', 80);
      $table->string('image_url')->nullable();
      $table->string('image_url_id')->nullable();
      $table->foreignId('cinema_id')->constrained('cinemas', 'id');
      $table->foreignId('country_id')->constrained('countries', 'id');
      $table->integer('order')->nullable();
      $table->tinyInteger('status')->default(1);
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('movies');
  }
};
