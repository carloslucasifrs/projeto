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
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('birth_date')->nullable();
            $table->string('genre', 30)->nullable();
            $table->string('biologic_sex', 30)->nullable();
            $table->string('nationality', 30)->nullable();
            $table->string('place_of_birth', 30)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('zipcode', 8)->nullable();
            $table->string('number', 20)->nullable();
            $table->string('complement', 20)->nullable();
            $table->boolean('admin')->default('false');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('birth_date');
            $table->dropColumn('genre');
            $table->dropColumn('biologic_sex');
            $table->dropColumn('nationality');
            $table->dropColumn('place_of_birth');
            $table->dropColumn('phone');
            $table->dropColumn('zipcode');
            $table->dropColumn('number');
            $table->dropColumn('complement');
        });
    }
};
