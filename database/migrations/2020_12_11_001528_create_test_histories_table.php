<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('test_number');
            $table->timestamp('start_time');
            $table->unsignedDecimal('array_generation_time', 10, 1);
            $table->unsignedDecimal('query_execution_time', 10, 1);
            $table->unsignedInteger('num_records');
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
        Schema::dropIfExists('test_histories');
    }
}
