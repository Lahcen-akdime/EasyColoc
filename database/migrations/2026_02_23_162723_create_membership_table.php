<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Schema;

use function Symfony\Component\Clock\now;

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
            $table->enum('type',['member','owner'])->default('owner');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('colocation_id')->constrained()->onDelete('cascade');
            $table->date('joined_at')->default(Carbon::now());
            $table->date('left_at')->nullable();
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
