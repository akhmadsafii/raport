<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\Manual\ScoreRequest;
use App\Models\ScoreManual;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreManualController extends Controller
{
    public function index()
    {
        $students = StudentClass::join('users', 'student_classes.id_student', '=', 'users.id')
            ->select('student_classes.id', 'student_classes.slug', 'student_classes.id_student', 'student_classes.status',  'student_classes.year', 'users.name', 'users.gender', 'users.file', 'users.email', 'users.place_of_birth', 'users.date_of_birth')
            ->where([
                ['id_study_class', session('teachers.id_study_class')],
                ['year', session('year')],
                ['student_classes.status', 1],
            ])->get();

        $result = [];
        foreach ($students as $student) {
            $score = ScoreManual::where([
                ['id_student_class', $student->id],
                ['id_study_class', session('teachers.id_study_class')],
                ['id_teacher', Auth::guard('teacher')->user()->id],
                ['id_course', session('teachers.id_course')],
                ['id_school_year', session('id_school_year')]
            ])->first();

            $result[] = [
                'id_student_class' => $student->id,
                'file' => $student->file,
                'name' => $student->name,
                'id_study_class' =>  session('teachers.id_study_class'),
                'id_teacher' => Auth::guard('teacher')->user()->id,
                'id_course' => session('teachers.id_course'),
                'id_school_year' => session('id_school_year'),
                'assigment_grade' => $score ? $score->assigment_grade : 0,
                'daily_test_score' => $score ? $score->daily_test_score : 0,
                'score_uts' => $score ? $score->score_uts : 0,
                'score_uas' => $score ? $score->score_uas : 0,
                'score_final' => $score ? $score->score_final : 0,
                'predicate' => $score ? $score->predicate : null,
                'description' => $score ? $score->description : null,
            ];
        }
        // dd($result);
        return view('content.score_manual.v_student_score', compact('result'));
    }

    public function storeOrUpdate(ScoreRequest $request)
    {
        // dd($request);
        $data = $request->validated();
        // dd($data);

        foreach ($data['id_student_class'] as $index => $id_student_class) {
            ScoreManual::updateOrCreate(
                [
                    'id_student_class' => $id_student_class,
                    'id_teacher' => Auth::guard('teacher')->user()->id,
                    'id_study_class' => session('teachers.id_study_class'),
                    'id_course' => session('teachers.id_course'),
                    'id_school_year' => session('id_school_year'),
                ],
                [
                    'assigment_grade' => $request->assigment_grade[$index],
                    'daily_test_score' => $request->daily_test_score[$index],
                    'score_uts' => $request->score_uts[$index],
                    'score_uas' => $request->score_uas[$index],
                    'predicate' => $request->predicate[$index],
                    'score_final' => $request->score_final[$index], // isi sesuai logikanya
                    'description' => $request->description[$index],
                ]
            );
        }
        Helper::toast('Berhasil menyimpan nilai', 'success');
        return redirect()->back();
    }
}
