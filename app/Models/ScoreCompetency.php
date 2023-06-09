<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScoreCompetency extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "score_competencies";

    protected $guarded = [];

    protected $dates = ['deleted_at'];
}
