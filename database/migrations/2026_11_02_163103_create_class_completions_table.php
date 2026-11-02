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
        Schema::create('class_completions', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
    
            $table->string('google_event_id')->unique();
    
            $table->timestamp('completed_at')->nullable();
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_completions');
    }
};
