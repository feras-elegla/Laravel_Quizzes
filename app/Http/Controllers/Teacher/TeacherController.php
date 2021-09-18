<?php

namespace App\Http\Controllers\Teacher;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TeacherRequest;

class TeacherController extends Controller
{

    public function index()
    {
       $teachers=User::Selection()->where('type',"teacher")->get();
        return view("admin.Teacher.index",compact('teachers'));
    }


    public function create()
    {
        return view("admin.Teacher.create");
    }


    public function store(TeacherRequest   $request)
    {
        try {


            if (!$request->has('status')) {
                $request->request->add(['status' => 0]);
            } else {
                $request->request->add(['status' => 1]);
            }
            User::create([
                'name' =>$request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'type' =>"teacher",
                'status' => $request->status,
            ]);

            return redirect()->route("teachers")->with('success', "تمت عمليه الاضافه بنجاح");
        } catch (\Exception $ex) {
            return redirect()->route("teachers")->with('error', ' يوجد خطأ ما ف العمليه ');
        }

    }

    public function changeStatus($id)
    {
        try {
            $teacher = User::find($id);
            if (!$teacher) {
                return view("teachers")->with('error', '   هذا المستخدم غير موجود');
            }
            $status = $teacher->status == 0 ? 1 : 0;
            $teacher->update([ 'status' =>  $status]);

            return redirect()->route("teachers")->with('success', ' تمت   تغيير الحاله بنجاح ');
        } catch (\Exception $ex) {

            return redirect()->route("teachers")->with('error', '  يوجد خطأ ما ف العمليه  ');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try {
            $teacher = User::selection()->find($id);

            if (!$teacher) {
                return view("teachers")->with('error', '   هذا المستخدم غير موجود');
            }

            return view("admin.Teacher.edit", compact('teacher'));
        } catch (\Exception $ex) {

            return redirect()->route("admin.maincategories")->with('error', '  يوجد خطأ ما ف العمليه  ');
        }
    }

    public function update(TeacherRequest  $request, $id)
    {
        try {
              $teacher= User::find($id);

             if (!$teacher) {
                return view("teachers")->with('error', '   هذا المستخدم غير موجود');
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
                'type' =>"teacher",
                'status' => $request->status
            ]);

            return redirect()->route("teachers")->with('success', "تمت عمليه الاضافه بنجاح");
        } catch (\Exception $ex) {
            return redirect()->route("teachers")->with('error', ' يوجد خطأ ما ف العمليه ');
        }
    }


    public function destroy($id)
    {
        try {
            $teacher = User::find($id);
            if (!$teacher) {
                return redirect()->route("teachers")->with('error', "   هذا المستخدم غير موجود");
            }
            $teacher->delete($id);
            return redirect()->route("teachers")->with('success', "تمت عمليه الحذف بنجاح");
        } catch (\Exception $ex) {

            return redirect()->route("teachers")->with('error', '  يوجد خطأ ما ف العمليه  ');
        }
    }
}
