<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return url('subjects/images/' . $this->image);
    }


    public function topics()
    {
        return $this->hasMany(Topic::class, 'subject_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function myClass()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function chapters()
    {
        return $this->hasMany(SubjectChapter::class);
    }
}
