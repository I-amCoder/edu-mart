<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $appends = ['logo_path,favicon_path'];


    public function getLogoPathAttribute()
    {
        return url('site-settings/logos/' . $this->site_logo);
    }

    public function getFaviconPathAttribute()
    {
        return url('site-settings/favicons/' . $this->favicon);
    }
}
