<?php

use App\Models\Category;
use App\Models\User;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignIdFor(User::class)
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)
                ->constrained();

            $table->string('title');
            $table->text('description');
            $table->date('start_date');
            $table->date('due_date');
            $table->enum('status', ['pending', 'ongoing', 'done'])
                ->default('pending');
            $table->enum('priority', ['low', 'high'])
                ->default('high');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
