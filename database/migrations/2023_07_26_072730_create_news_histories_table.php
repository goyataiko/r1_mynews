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
        Schema::create('news_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('news_id');
            $table->string('news_title');
            $table->string('edited_at');
            $table->timestamps();
        });
        
        // Schema::create('profile_histories', function (Blueprint $table) {
        //     $table->id();
        //     $table->bigInteger('profile_id');
        //     $table->string('profile_name');
        //     $table->string('edited_at_profile');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_histories');
    }
};
