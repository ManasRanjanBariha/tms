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
    Schema::create('teams', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('project_manager_id');
        $table->timestamps();

        $table->foreign('project_manager_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('teams');
}

};
