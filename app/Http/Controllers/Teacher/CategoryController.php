<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategroyRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoreis=Category::selection()->get();
        return view('admin.Teacher.Categories.index',compact('categoreis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.Teacher.Categories.create');
    }


    public function store(CategroyRequest $request)
    {

        try {

            Category::create([
                'name' =>$request->name,
                'type' => $request->type,
                'parent_id' =>($request->parent_id==null)?0:$request->parent_id,

            ]);

            return redirect()->route("categoris")->with('success', "تمت عمليه الاضافه بنجاح");
        } catch (\Exception $ex) {
            return redirect()->route("categoris")->with('error', ' يوجد خطأ ما ف العمليه ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = Category::selection()->find($id);

            if (!$category) {
                return redirect()->route("categoris")->with('error', '   هذا المستخدم غير موجود');
            }

            return view("admin.Teacher.Categories.edit", compact('category'));
        } catch (\Exception $ex) {

            return redirect()->route("categoris")->with('error', '  يوجد خطأ ما ف العمليه  ');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategroyRequest $request, $id)
    {
        try {
            $category= Category::find($id);

           if (!$category) {
            return redirect()->route("categoris")->with('error', '   هذه الفئة غير موجودة');
        }

        Category::where('id',$id)->update([
              'name' =>$request->name,
              'type' =>$request->type,
              'parent_id' => $request->parent_id
          ]);

          return redirect()->route("categoris")->with('success', "تمت عمليه التعديل بنجاح");
      } catch (\Exception $ex) {
          return redirect()->route("categoris")->with('error', ' يوجد خطأ ما ف العمليه ');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::find($id)->with('questions');
            if (!$category) {
                return redirect()->route("categoris")->with('error', '   هذه الفئة غير موجودة');
            }
            if (!$category) {
                $category->delete($id);
                return redirect()->route("categoris")->with('success', "تمت عمليه الحذف بنجاح");

            }else
            return redirect()->route("categoris")->with('error', " عمليه الحذف غير مقبوله");

        } catch (\Exception $ex) {
            return redirect()->route("categoris")->with('error', ' يوجد خطأ ما ف العمليه ');
        }
    }


    public function getCategory(Request $request)
    {

        try {
            if($request->type=="Course"){
                    $category = Category::where('type','Grade')->get();
                    return response()->json(['category'=>$category]);

            }
            else if($request->type=="Unit"){
                $category = Category::where('type','Course')->get();
                return response()->json(['category'=>$category]);

            }else if($request->type=="Lesson"){
                $category = Category::where('type','Unit')->get();
                return response()->json(['category'=>$category]);

            }

        } catch (\Exception $ex) {
            return redirect()->route("categoris")->with('error', ' يوجد خطأ ما ف العمليه ');
        }
    }

}
