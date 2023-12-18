<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alcalde extends Model
{
    use HasFactory;

    protected $fillable = ['name_alcalde','content_alcalde','image_alcalde'];
}
