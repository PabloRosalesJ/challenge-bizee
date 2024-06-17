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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(table: 'users');
            $table->foreignId('state_id')->constrained(table: 'states');
            $table->foreignId('registered_agent_id')->nullable()->constrained('registered_agents', 'id')->onDelete('set null');
            $table->string('name')->unique();
            $table->enum('registered_agent_type', [1, 2])->comment('use 1 to registered agent and 2 to user entity');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
