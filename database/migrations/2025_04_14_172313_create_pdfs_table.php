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
        // Schema::create('pdfs', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title');
        //     $table->text('description')->nullable();
        //     $table->string('file_path');
        //     $table->decimal('price', 8, 2);
        //     $table->timestamps();
        // });

        // database/migrations/xxxx_xx_xx_create_pdfs_table.php

        // Schema::create('pdfs', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title');
        //     $table->text('description')->nullable();
        //     $table->string('file_path');
        //     $table->string('image_path')->nullable(); // 👈 جديد
        //     $table->decimal('price', 8, 2);
        //     $table->timestamps();
        // });
        Schema::create('pdfs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('image_path')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('category')->nullable(); // 👈
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdfs');
    }
};
