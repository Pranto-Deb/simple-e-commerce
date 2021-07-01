<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizeables', function (Blueprint $table) {
            $table->unsignedBigInteger('size_id');
            $table->foreign('size_id')->references('size_id')->on('sizes')->cascadeOnDelete();
            $table->morphs('sizeable');
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
        Schema::dropIfExists('sizeables');
    }
}
