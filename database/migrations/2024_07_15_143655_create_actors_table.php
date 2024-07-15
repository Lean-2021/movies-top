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
      Schema::create('actors', function (Blueprint $table) {
        $table->id();
        $table->string('first_name', 100);
        $table->string('last_name', 100);
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
      Schema::dropIfExists('actors');
    }
  };
