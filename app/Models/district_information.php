<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class district_information extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];
}
