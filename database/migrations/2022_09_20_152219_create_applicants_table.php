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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('rank_id');
            $table->string('role_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('username');
            $table->string('church');
            $table->string('zone');
            $table->string('region');
            $table->string('department');
            $table->string('family');
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
        Schema::dropIfExists('applicants');
    }
};
