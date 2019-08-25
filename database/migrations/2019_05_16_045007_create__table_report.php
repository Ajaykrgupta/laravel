<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::connection('workreport_db_connect')->create('report', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('project_id');
            $table->string('task',200);
            $table->string('hours',200);
            $table->date('task_date');
            $table->integer('user_id');
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
         Schema::dropIfExists('report');
    }
}
