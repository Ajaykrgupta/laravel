<?php

namespace App\Model\WorkReport;

use Illuminate\Database\Eloquent\Model;

class ProjectTbModel extends Model
{
    protected $connection = 'workreport_db_connect';
    protected $table = "project_tb";
}
