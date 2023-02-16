<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    public function subClasses()
    {
        return $this->hasMany(Classes::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Classes::class, 'parent_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'class_id');
    }
}
