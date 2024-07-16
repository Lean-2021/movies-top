<?php

  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;

  return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('cinemas', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
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
      Schema::dropIfExists('cinemas');
    }
  };
