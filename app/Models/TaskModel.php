<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use HasFactory;

    protected $table = 'task';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'section_id',
    	'task_name',
    	'task_state',
    ];

    public function section()
    {
        return $this->hasOne(SectionModel::class, 'id', 'section_id');
    }
}
