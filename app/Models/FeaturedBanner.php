<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedBanner extends Model
{
    use HasFactory;
    protected $table = 'featured_banner';

    protected $fillable = [

        'title',
        'dimension',
        'image',
        'status',
    ];
}
