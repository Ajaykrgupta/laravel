<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableErpTaskMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::connection('workreport_db_connect')->create('erp_task_master', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('project_id');
            $table->text('task_name');
            $table->tinyInteger('task_status');
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
        Schema::dropIfExists('erp_task_master');
    }
}
