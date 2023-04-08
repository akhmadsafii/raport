<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Extracurricular extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "extracurriculars";

    protected $guarded = [];

    protected $dates = ['deleted_at'];
}
