<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionModel extends Model
{
    use HasFactory;

    protected $table = 'section';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'section_name'
    ];
    
    public function task()
    {
        return $this->hasMany(TaskModel::class, 'section_id', 'id');
    }
}
