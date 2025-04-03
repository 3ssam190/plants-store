<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('plants', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('type');
        $table->decimal('price', 8, 2);
        $table->string('environment');
        $table->string('image_path')->nullable();
        $table->softDeletes(); // Add soft delete here
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
