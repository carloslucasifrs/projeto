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
        Schema::create('referencevalues', function (Blueprint $table) {
            $table->id();
            $table->string('rule');
            $table->string('biologic_sex');
            $table->integer('age_min');
            $table->integer('age_max');
            $table->decimal('value_min', 8, 3);
            $table->decimal('value_max', 8, 3);
            $table->foreignId('laboratoryexam_id')
                ->constrained('laboratoryexams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('referencevalues');
    }
};
