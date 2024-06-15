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
        Schema::create('registered_agents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained(table: 'states');
            $table->string('name');
            $table->string('email', 150)->unique();
            $table->unsignedSmallInteger('capacity')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registered_agents');
    }
};
