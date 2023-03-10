<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;

    public function jobs()
    {
        return $this->hasMany(JobsBlog::class, 'job_category_id');
    }

    public function subCategories()
    {
        return $this->hasMany(JobCategory::class, 'parent_id');
    }

    public function scopeMain()
    {
        return $this->where('parent_id', 0)->get();
    }

    public function scopeChilds()
    {
        return $this->whereNot('parent_id', 0)->get();
    }
}
