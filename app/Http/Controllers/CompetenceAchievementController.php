<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\P5\CompetenceRequest;
use App\Models\CompetenceAchievement;
use App\Models\Course;
use App\Models\StudyClass;
use App\Models\SubjectTeacher;
use App\Models\Teacher;
use App\Models\TypeCompetenceAchievement;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompetenceAchievementController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Kelola Capaian Kompetensi');
        $courses = [];
        $subject_teacher = SubjectTeacher::all();
        foreach ($subject_teacher as $item) {
            $studyClassIds = json_decode($item->id_study_class, true);

            foreach ($studyClassIds as $studyClassId) {
                $course = Course::find($item->id_course);
                $studyClass = StudyClass::find($studyClassId);
                $teacher = Teacher::find($item->id_teacher);

                $courses[] = [
                    'id_course' => $course->id,
                    'name_mapel' => $course->name,
                    'slug_mapel' => $course->slug,
                    'id_study_class' => $studyClass->id,
                    'name_class' => $studyClass->name,
                    'slug_class' => $studyClass->slug,
                    'id_teacher' => $teacher->id,
                    'name_teacher' => $teacher->name,
                    'slug_teacher' => $teacher->slug,
                ];
            }
        }
        $courses = collect($courses)->unique(function ($item) {
            return $item['id_course'] . $item['id_study_class'];
        })->values()->all();
        // dd($courses);
        if ($request->ajax()) {
            $data = CompetenceAchievement::with('type')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $alert = "return confirm('Apa kamu yakin?')";
                    return '<div class="dropdown dropup  custom-dropdown-icon">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink-3">
                        <a class="dropdown-item" href="' . route('setting_scores.competence.edit', ['course' => $row->course->slug, 'study_class' => $row->study_class->slug, 'teacher' => $row->teacher->slug, 'slug' => $row->slug]) . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon></svg> Edit</a>
                        <a class="dropdown-item"  onclick="' . $alert . '" href="' . route('setting_scores.competence.destroy', $row['slug']) . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Hapus</a>
                    </div>
                </div> ';
                })
                ->editColumn('description', function ($row) {
                    return str_limit($row['description'], 50);
                })

                ->rawColumns(['action', 'description'])
                ->make(true);
        }
        // dd($courses);
        return view('content.score_p5.v_achievement_competence', compact('courses'));
    }

    public function create(Request $request)
    {
        session()->put('title', 'Tambah Data');
        $course = Course::where('slug', $request->course)->first();
        $study_class = StudyClass::with('major', 'level')->where('slug', $request->study_class)->first();
        $teacher = Teacher::where('slug', $request->teacher)->first();
        $types = TypeCompetenceAchievement::all();
        return view('content.score_p5.v_create_competence', compact('course', 'teacher', 'study_class', 'types'));
    }

    public function edit(Request $request)
    {
        session()->put('title', 'Tambah Data');
        $course = Course::where('slug', $request->course)->first();
        $study_class = StudyClass::with('major', 'level')->where('slug', $request->study_class)->first();
        $teacher = Teacher::where('slug', $request->teacher)->first();
        $types = TypeCompetenceAchievement::all();
        $competence = CompetenceAchievement::where('slug', $request->slug)->first();
        return view('content.score_p5.v_create_competence', compact('course', 'teacher', 'study_class', 'types', 'competence'));
    }

    public function storeOrUpdate(CompetenceRequest $request, $id = null)
    {
        $data = $request->validated();

        CompetenceAchievement::updateOrCreate(
            ['id' => $id],
            [
                'id_course' => $data['id_course'],
                'id_study_class' => $data['id_study_class'],
                'id_teacher' => $data['id_teacher'],
                'id_type_competence' => $data['id_type_competence'],
                'id_school_year' => session('id_school_year'),
                'code' => $data['code'],
                'achievement' => $data['achievement'],
                'slug' => str_slug($data['achievement']) . '-' . Helper::str_random(5),
                'description' => $data['description']
            ]
        );
        Helper::toast('Berhasil mengupdate kompetensi', 'success');
        return redirect()->route('setting_scores.competence');
    }

    public function destroy($slug)
    {
        $data = CompetenceAchievement::where('slug', $slug)->delete();
        // dd($data);
        Helper::toast('Berhasil menghapus kompetensi', 'success');
        return redirect()->back();
    }
}