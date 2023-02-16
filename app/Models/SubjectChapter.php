<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectChapter extends Model
{
    use HasFactory;

    public function topics()
    {
        return $this->hasMany(Topic::class, 'chapter_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
