<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('task_id')->default(DB::raw('(UUID())'))->primary();
            $table->foreignUuid('user_id')
            ->references('user_id')
            ->on('users')
            ->onDelete('cascade');
            
            $table->string('title', 128)->unique();
            $table->string('description', 349);
            $table->enum('status', ['TODO', 'DOING', 'DONE']);
            $table->dateTime('due_date')->nullable();    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
