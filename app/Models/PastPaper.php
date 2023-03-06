<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastPaper extends Model
{
    use HasFactory;

    protected $appends = ['show_pdf'];
    public function getShowPdfAttribute()
    {
        return url('files/pastpaper/' . $this->file);
    }
}
