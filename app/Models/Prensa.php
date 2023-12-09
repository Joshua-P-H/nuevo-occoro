<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prensa extends Model
{
    use HasFactory;
    protected $fillable = ['title_prensa','content_prensa','image_prensa'];

}
