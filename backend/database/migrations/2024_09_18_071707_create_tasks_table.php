<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->unsignedBigInteger('assigned_to')->nullable();
        $table->unsignedBigInteger('project_id');
        $table->enum('status', ['to_do', 'in_progress', 'done', 'review', 'completed']);
        $table->enum('priority', ['low', 'medium', 'high'])->nullable();
        $table->date('due_date')->nullable();
        $table->unsignedBigInteger('created_by');
        $table->timestamps();

        $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
        $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('tasks');
}

};
