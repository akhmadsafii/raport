<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\P5\AssesementRequest;
use App\Models\AssesmentWeighting;
use App\Models\StudyClass;
use App\Models\SubjectTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssesmentWeightingController extends Controller
{
    public function index()
    {
        $subjectTeachers = SubjectTeacher::where('status', 1)->get(['id_study_class']);

        $idStudyClasses = collect([]);

        foreach ($subjectTeachers as $subjectTeacher) {
            $idStudyClasses = $idStudyClasses->merge(json_decode($subjectTeacher->id_study_class));
        }

        $classes = StudyClass::whereIn('id', $idStudyClasses->unique())
            ->get(['slug', 'name']);


        if (isset($_GET['study_class'])) {
            $study_class = StudyClass::where('slug', $_GET['study_class'])->first();
            $datas = SubjectTeacher::with('teacher', 'course')
                ->whereRaw('JSON_CONTAINS(id_study_class, \'["' . $study_class->id . '"]\')')
                ->where('status', 1)
                ->get();

            $assesment_weightings = DB::table('assesment_weightings')
                ->join('teachers', 'teachers.id', '=', 'assesment_weightings.id_teacher')
                ->where('assesment_weightings.id_study_class', $study_class->id)
                ->get();

            $result = [];
            foreach ($datas as $data) {
                $found = $assesment_weightings->first(function ($item) use ($data) {
                    return $item->id_course == $data->id_course
                        && $item->id_teacher == $data->id_teacher
                        && $item->id_school_year == $data->id_school_year;
                });

                $score_formatif = $found ? $found->formative_weight : null;
                $score_sumatif = $found ? $found->sumative_weight : null;

                $result[] = [
                    'course' => $data->course->name,
                    'teacher' => $data->teacher->name,
                    'score_formatif' => $score_formatif,
                    'score_sumatif' => $score_sumatif,
                    'id_teacher' => $data->id_teacher,
                    'id_course' => $data->id_course,
                    'id_study_class' => $study_class->id,
                    'id_school_year' => $data->id_school_year,
                ];
            }
            // dd($result);
        } else {
            $result = [];
        }
        // dd($datas);
        return view('content.score_p5.v_assesment_weighting', compact('classes', 'result'));
    }

    public function storeOrUpdate(AssesementRequest $request)
    {
        // dd($request);
        $data = $request->validated();
        $id = $data['id_teacher'];

        for ($i = 0; $i < count($id); $i++) {
            $result = AssesmentWeighting::updateOrCreate(
                [
                    'id_teacher' => $id[$i],
                    'id_course' => $data['id_course'][$i],
                    'id_study_class' => $data['id_study_class'][$i],
                    'id_school_year' => session('id_school_year')
                ],
                [
                    'formative_weight' => $data['formative_weight'][$i],
                    'sumative_weight' => $data['sumative_weight'][$i]
                ]
            );
        }
        Helper::toast('Berhasil mengupdate bobot penilaian', 'success');
        return redirect()->back();
    }
}
