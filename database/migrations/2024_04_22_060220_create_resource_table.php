<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource', function (Blueprint $table) {
            $table->id('id');
            $table->date('date');
            $table->time('time_from');
            $table->time('time_to');
            $table->string('day');
            $table->string('user_id');
            $table->string('department');
            $table->string('activity_id');
            $table->string('class_id');
            $table->string('location_id');
            $table->string('remarks');
            $table->boolean('admissible')->default(false);
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
        Schema::dropIfExists('resource');
    }
};
