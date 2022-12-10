<?php

declare(strict_types=1);

use App\Models\Exam;
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
        Schema::create('exam_laboratoryexam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')
                ->constrained('exams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('laboratoryexam_id')
                ->constrained('laboratoryexams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->decimal('value', 8, 2);
            $table->timestamps();
            $table->unique(['exam_id', 'laboratoryexam_id']);
            // $table->primary(['exam_id', 'laboratoryexam_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_laboratoryexams');
    }
};
