<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobsBlog extends Model
{
    use HasFactory;

    protected $appends = ['image_path', 'urdu_pdf', 'english_pdf'];

    public function getImagePathAttribute()
    {
        return url('jobs/images/' . $this->image);
    }

    public function getUrduPdfAttribute()
    {
        return url('jobs/files/' . $this->pdf_urdu);
    }

    public function getEnglishPdfAttribute()
    {
        return url('jobs/files/' . $this->pdf_english);
    }

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }
}
