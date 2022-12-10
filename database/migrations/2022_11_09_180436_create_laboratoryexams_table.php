<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('laboratoryexams', function (Blueprint $table) {
            $table->id();
            $table->string('exam')->unique();
            $table->text('description');
            $table->string('material')->nullable();
            $table->string('method')->nullable();
            $table->text('use')->nullable();
            $table->string('bibliography')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratoryexams');
    }
};
