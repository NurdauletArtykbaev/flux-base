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
        Schema::create('complaint_reasons', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('sort')->nullable();
            $table->boolean('is_for_user')->default(false);
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
        Schema::dropIfExists('complaint_reasons');
    }
};
