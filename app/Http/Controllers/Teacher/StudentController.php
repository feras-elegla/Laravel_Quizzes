<?php

namespace App\Http\Controllers\Teacher;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TeacherRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students=User::Selection()->where('type',"student")->get();
        return view("admin.Teacher.Teacher_Student.index",compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function changeStatus($id)
    {

        try {
            $student = User::find($id);
            if (!$student) {
                return view("students")->with('error', '   هذا المستخدم غير موجود');
            }
            $status = $student->status == 0 ? 1 : 0;
            $student->update([ 'status' =>  $status]);

            return redirect()->route("students")->with('success', ' تمت   تغيير الحاله بنجاح ');
        } catch (\Exception $ex) {

            return redirect()->route("students")->with('error', '  يوجد خطأ ما ف العمليه  ');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try {
            $students = User::selection()->find($id);

            if (!$students) {
                return view("students")->with('error', '   هذا المستخدم غير موجود');
            }

            return view("admin.Teacher.Teacher_Student.edit", compact('students'));
        } catch (\Exception $ex) {

            return redirect()->route("students")->with('error', '  يوجد خطأ ما ف العمليه  ');
        }
    }

    public function update(TeacherRequest  $request, $id)
    {
        try {
              $student= User::find($id);

             if (!$student) {
                return view("students")->with('error', '   هذا المستخدم غير موجود');
            }
            if (!$request->has('status')) {
                $request->request->add(['status' => 0]);
            } else {
                $request->request->add(['status' => 1]);
            }
            User::where('id',$id)->update([
                'name' =>$request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'type' =>"student",
                'status' => $request->status
            ]);

            return redirect()->route("students")->with('success', "تمت عمليه الاضافه بنجاح");
        } catch (\Exception $ex) {
            return redirect()->route("students")->with('error', ' يوجد خطأ ما ف العمليه ');
        }
    }


    public function destroy($id)
    {
        try {
            $student = User::find($id);
            if (!$student) {
                return redirect()->route("students")->with('error', "   هذا المستخدم غير موجود");
            }
            $student->delete($id);
            return redirect()->route("students")->with('success', "تمت عمليه الحذف بنجاح");
        } catch (\Exception $ex) {

            return redirect()->route("students")->with('error', '  يوجد خطأ ما ف العمليه  ');
        }
    }
}
