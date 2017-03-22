<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parent_table extends Model
{
    //
    protected $fillable = ['name'];

    public function setTable($tablename)
    {
    	$this->table = $tablename;
    }
}
