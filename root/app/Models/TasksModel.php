<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasksModel extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $primaryKey = 'ta_id';

    public $timestamps = false;

    protected $fillable = [
        'ta_description',
        'ta_usid',
        'ta_estimatedtime',
        'ta_usedtime',
        'ta_createdat',
        'ta_completedat'
    ];
}
