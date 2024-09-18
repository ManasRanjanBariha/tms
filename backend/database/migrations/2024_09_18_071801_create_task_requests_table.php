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
    Schema::create('task_requests', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('requested_by');
        $table->unsignedBigInteger('task_id');
        $table->enum('status', ['pending', 'approved', 'rejected']);
        $table->timestamp('requested_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        $table->timestamp('reviewed_at')->nullable();
        $table->timestamps();

        $table->foreign('requested_by')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('task_requests');
}

};
