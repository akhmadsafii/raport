<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeCompetenceAchievement extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "type_competence_achievements";

    protected $guarded = [];

    protected $dates = ['deleted_at'];
}