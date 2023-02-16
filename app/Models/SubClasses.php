<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubClasses extends Model
{
    use HasFactory;

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'class_id');
    }
}
