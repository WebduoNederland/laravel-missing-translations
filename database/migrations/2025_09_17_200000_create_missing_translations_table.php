<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('missing_translations', function (Blueprint $table): void {
            $table->id();
            $table->string('key');
            $table->string('locale')->nullable();
            $table->bigInteger('total_occurrences')->default(1)->index();
            $table->dateTime('first_occurrence')->index();
            $table->dateTime('last_occurrence')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('missing_translations');
    }
};
