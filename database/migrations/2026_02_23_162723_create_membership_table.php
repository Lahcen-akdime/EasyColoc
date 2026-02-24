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
        Schema::create('membership', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('type',['member','owner']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('colocation_id')->constrained()->onDelete('cascade');
            $table->date('joined_at');
            $table->date('left_at');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_');
    }
};
