<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Answer;
use App\Helpers;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $questions =Question::selection()->with('answers')->get();

        return view('admin.Teacher.Question.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategoris = Category::get();
        $root_Categoris = $allCategoris->where('parent_id', 0);

        formatTree($root_Categoris, $allCategoris);

        return view('admin.Teacher.Question.create',compact('root_Categoris'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $Question_default_id = Question::insertGetId([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'correct_ansowre'=> 0
            ]);
            foreach($request->answers as $key => $answer){

                if($answer['answer'] != null){

                    Answer::create([
                        'title'=>$answer['answer'],
                        'question_id'=>$Question_default_id,
                        'iscorrect'=> array_key_exists('correct', $answer)? '1' : '0'
                    ]);
                }
            }
            $danswers = Answer::where( 'question_id' , $Question_default_id)->get();


            // ----------------get id for correct id ---------------------
          $correct_id = Answer::where('question_id',$Question_default_id)->where('iscorrect',1)->get();
            // -----------------update mainquestion------------------
            Question::where('id',$Question_default_id)->update([
                     'correct_ansowre'=>  $correct_id[0]->id
            ]);

            return redirect()->route("questions")->with('success', 'تمت عمليه الاضافه بنجاح');
        } catch (\Exception $ex) {

            return redirect()->route("questions")->with('error', 'فشلت عمليه الاضافه ');
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
        $allCategoris = Category::get();
        $root_Categoris = $allCategoris->where('parent_id', 0);
        formatTree($root_Categoris, $allCategoris);

        $question= Question::where('id',$id)->selection()->with('answers')->get()[0];

          return view("admin.Teacher.Question.edit",compact('question','root_Categoris'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $question=Question::where('id',$id)->get()[0];
            $question->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'correct_ansowre'=> 0
            ]);


     foreach($request->answers as $key => $answer){
         if($answer['answer'] != null){
            $findanswer=Answer::where('id',$question->answers[$key]->id)->get()[0];
            $findanswer->update([
                 'title'=>$answer['answer'],
                 'question_id'=>$id,
                 'iscorrect'=> array_key_exists('correct', $answer)? '1' : '0'
             ]);
         }
     }


     // ----------------get id for correct id ---------------------
   $correct_id = Answer::where('question_id',$id)->where('iscorrect',1)->get();
     // -----------------update mainquestion------------------
     Question::where('id',$id)->update([
              'correct_ansowre'=>  $correct_id[0]->id
     ]);

     return redirect()->route("questions")->with('success', 'تمت عمليه التعديل بنجاح');
 } catch (\Exception $ex) {
return $ex;
     return redirect()->route("questions")->with('error', 'فشلت عمليه التعديل ');
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
            $question=Question::where('id',$id)->with('answers')->get()[0];

            if(!empty($question->answers)){
                foreach($question->answers as $answer){
                $answer->delete();

            }
            }
            $question->delete();
     return redirect()->route("questions")->with('success', 'تمت عمليه الحذف بنجاح');
 } catch (\Exception $ex) {
     return $ex;
     return redirect()->route("questions")->with('error', 'فشلت عمليه الحذف ');
 }
    }
}
