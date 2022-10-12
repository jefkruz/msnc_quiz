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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('exam_duration');
            $table->integer('category_questions');
            $table->integer('essay_questions');
            $table->timestamps();
        });

        $s = new \App\Models\Setting();
        $s->exam_duration = 3605;
        $s->category_questions = 10;
        $s->essay_questions = 10;
        $s->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
