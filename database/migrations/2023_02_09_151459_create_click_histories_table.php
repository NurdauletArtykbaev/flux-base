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
        Schema::create('click_histories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('count')->default(0);
            $table->string('platform')->nullable();
            $table->string('ip')->nullable();
            $table->foreignId('clicked_user_id')->nullable();
            $table->text('fields')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('click_histories');
    }
};
