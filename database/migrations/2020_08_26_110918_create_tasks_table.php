<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses');
            $table->unsignedInteger('created_by_id');
            $table->foreign('created_by_id')
                ->references('id')
                ->on('users');
            $table->unsignedInteger('assigned_to_id');
            $table->foreign('assigned_to_id')
                ->references('id')
                ->on('users');
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
}
