<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Response;


class Topic extends Model
{
    use HasFactory;

    protected $appends = ['image_path', 'show_pdf'];

    public function getImagePathAttribute()
    {
        return url('topics/images/' . $this->image);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function getShowPdfAttribute()
    {
        return url('topics/files/' . $this->file);
    }
}
