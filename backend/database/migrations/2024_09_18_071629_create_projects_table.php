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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();
        $table->unsignedBigInteger('project_manager_id');
        $table->unsignedBigInteger('team_id');
        $table->enum('status', ['active', 'completed']);
        $table->timestamps();

        $table->foreign('project_manager_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('projects');
}

};
