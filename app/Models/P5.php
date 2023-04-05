<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class P5 extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "p5_s";

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function study_class()
    {
        return $this->belongsTo(StudyClass::class, 'id_study_class');
    }

    public function tema()
    {
        return $this->belongsTo(Tema::class, 'id_tema');
    }
}
