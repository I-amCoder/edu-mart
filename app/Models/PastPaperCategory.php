<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastPaperCategory extends Model
{
    use HasFactory;

    public function papers()
    {
        return $this->hasMany(PastPaper::class, 'past_paper_category_id');
    }
}
