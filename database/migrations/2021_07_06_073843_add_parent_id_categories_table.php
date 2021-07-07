<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedInteger('parent_id')->nullable()->after('category_id');
            $table->foreign('parent_id')->references('category_id')->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });
    }
}
