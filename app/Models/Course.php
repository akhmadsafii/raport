<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "courses";

    protected $fillable = [
        'slug', 'name', 'group', 'code', 'status'
    ];

    protected $dates = ['deleted_at'];

    public function subjectTeacher()
    {
        return $this->hasMany(SubjectTeacher::class, 'id_course');
    }
}