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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('species');
            $table->string('name');
            $table->integer('age')->unsigned()->default(0);
            $table->string('description');
            $table->unsignedBigInteger('cage_id');
            $table->timestamps();

            $table->foreign('cage_id')->references('id')->on('cages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals', function (Blueprint $table) {
            $table->dropForeign('cage_id');
            $table->dropIndex('cage_id');
            $table->dropColumn('cage_id');
        });
    }
};
