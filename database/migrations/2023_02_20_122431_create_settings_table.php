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
            $table->string('site_name');
            $table->string('site_logo');
            $table->string('copyright_text');
            $table->string('favicon');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->text('keywords');
            $table->string('whatsapp_no')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('pinterest_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('instagram_link')->nullable();

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
        Schema::dropIfExists('settings');
    }
};
