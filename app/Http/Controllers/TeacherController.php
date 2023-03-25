<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'LIST GURU');
        if ($request->ajax()) {
            $data = Teacher::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $alert = "confirm('Apa kamu yakin?')";
                    return '<div class="dropdown dropup  custom-dropdown-icon">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink-3">
                        <a class="dropdown-item" href="' . route('teachers.edit', $row['slug']) . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon></svg> Edit</a>
                        <a class="dropdown-item"  onclick="' . $alert . '" href="' . route('teachers.destroy', $row['slug']) . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Hapus</a>
                    </div>
                </div> ';
                })
                ->editColumn('name', function ($row) {
                    $file = asset('asset/img/90x90.jpg');
                    if ($row['file'] != null) {
                        $file = asset($row['file']);
                    }
                    return '<div class="d-flex">
                    <div class="usr-img-frame mr-2 rounded-circle">
                        <img alt="avatar" class="img-fluid rounded-circle" src="' . $file . '">
                    </div>
                    <p class="align-self-center mb-0 admin-name">' . $row['name'] . '</p>
                </div>';
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
        return view('content.teachers.v_teacher');
    }

    public function create()
    {
        return view('content.teachers.v_form_teacher');
    }

    public function store(StoreTeacherRequest $request)
    {
        $data = $request->toArray();
        if ($request->hasFile('file')) {
            $data = ImageHelper::upload_asset($request, 'file', 'profile', $data);
        }
        Teacher::create($data);
        Helper::toast('Berhasil menambah guru', 'success');
        return redirect()->route('teachers.index');
    }

    public function edit(Teacher $teacher, $slug)
    {
        $teacher = Teacher::where('slug', $slug)->firstOrFail();
        return view('content.teachers.v_form_teacher', compact('teacher'));
    }

    public function update(UpdateTeacherRequest $request, $slug)
    {
        $admin = Teacher::where('slug', $slug);
        $remove = [
            '_token', '_method', 'password_confirmation'
        ];
        if ($request->password) {
            $admin->update([
                'password' => Hash::make($request->password),
            ]);
        } else {
            array_push($remove, 'password');
        }
        $data = $request->except($remove);
        if ($request->hasFile('file')) {
            $data = ImageHelper::upload_asset($request, 'file', 'profile', $data);
        }
        $admin->update($data);
        Helper::toast('Berhasil mengupdate guru', 'success');
        return redirect()->route('teachers.index');
    }

    public function destroy($slug)
    {
        Teacher::where('slug', $slug)->delete();
        Helper::toast('Berhasil menghapus guru', 'success');
        return redirect()->route('teachers.index');
    }
}
