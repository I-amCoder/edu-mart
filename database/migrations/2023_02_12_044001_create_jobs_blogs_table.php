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
        Schema::create('jobs_blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_category_id')->default(0);
            $table->string('title');
            $table->string('apply_link')->nullable();
            $table->string('job_location');
            $table->string('newspaper_name');
            $table->string('job_type');
            $table->string('slug');
            $table->string('image');
            $table->string('pdf_english')->nullable();
            $table->string('pdf_urdu')->nullable();
            $table->longText('description');
            $table->dateTime('published_date');
            $table->dateTime('last_apply_date');
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
        Schema::dropIfExists('jobs_blogs');
    }
};
