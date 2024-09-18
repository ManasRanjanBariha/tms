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
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['project_manager', 'general_user'])->default('general_user');
        $table->unsignedBigInteger('team_id')->nullable();

        // $table->foreign('team_id')->references('id')->on('teams')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['team_id']);
        $table->dropColumn(['role', 'team_id']);
    });
}

};
