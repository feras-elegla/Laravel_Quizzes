<?php

namespace App\Http\Controllers\Student;

use App\Models\Quizzes;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use PHPUnit\Util\GlobalState;
use App\Models\Quizzes_Question;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuizzesController extends Controller
{

    public function index()
    {
        $Quizzes = Quizzes::selection()->where('User_id',Auth::user()->id)->get();
        return view('admin.Student.Quizzes.index', compact('Quizzes'));
    }


    public function create()
    {
        $allCategoris = Category::get();
        $root_Categoris = $allCategoris->where('parent_id', 0);
        formatTreeGetQuestion($root_Categoris, $allCategoris);
        return view('admin.Student.Quizzes.create', compact('root_Categoris'));
    }

    public function getQuizzes(Request $request)
    {

        try {
            $allCategoris = Category::get();
            $root_Categoris = $allCategoris->where('id', $request->category_id);
            formatTreeGetQuestion($root_Categoris, $allCategoris);

            $parent_id_category = [];
            $grade = [];
            $course = [];
            $unit = [];
            $lesson = [];

            foreach ($root_Categoris as $key => $category) {
                $grade[$key] = $category->id;
                foreach ($category->childern as $key => $categorychildren) {
                    $course[$key] = $categorychildren->id;
                    foreach ($categorychildren->childern as $key => $categorychildren2) {
                        $unit[$key] = $categorychildren2->id;
                        foreach ($categorychildren2->childern as $key => $categorychildren3) {
                            $lesson[$key] = $categorychildren3->id;
                        }
                    }
                }
            }

            $allParent_id = array_merge($grade, $course, $unit, $lesson);
            $questions = Question::whereIn('category_id', $allParent_id)
                ->with('answers')->get();
            $examquestion = [];
            if (count($questions) < 10) {
                foreach ($questions as $key => $question) {
                    $examquestion[$key] = $question;
                }
            } else {
                for ($x = 0; $x < 10; $x++) {
                    $examquestion[$x] = $questions[rand(0, count($questions) - 1)];
                }
            }
            $examquestion = collect($examquestion);
            // --------------------------------create Quizzes---------------------------------
            $Quizzes_id = Quizzes::insertGetId([
                'User_id' => Auth::User()->id,
                'category_id' => $request->category_id,
                'No_Question' => count($examquestion),
                'Quizze_duration' => 0,
                'start' => \Carbon\Carbon::now()

            ]);
            $Quizzes = Quizzes::where('id', $Quizzes_id)->get()[0];

            return view('admin.Student.Quizzes.show', compact('Quizzes'))->with('questions', $examquestion)->with('Quizzes_id', $Quizzes_id);
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route("questions.create")->with('error', '  يوجد خطأ في الاختبار يرجى المحاولة مرة اخرى ');
        }
    }

    public function store(Request $request)
    {
        try {

            foreach ($request['question'] as $key => $question) {
                $mainquestion = Question::where('id', $question['id'])->get()[0];
                Quizzes_Question::create([
                    'Quizze_id' => $request->quizze_id,
                    'Question_id' => $question['id'],
                    'Question_title' => $mainquestion['title'],
                    'iscorrect' => $question['iscorrect'] == $mainquestion->correct_ansowre ? 1 : 0,
                    'student_answer' => $question['iscorrect'],
                    'correct_answer' => $mainquestion->correct_ansowre,
                ]);
            }

            $grade = Quizzes_Question::where('Quizze_id', $request->quizze_id)->where('iscorrect', 1)->get();
            // --------------------update Quize ------------------------
            $Quizzes = Quizzes::where('id', $request->quizze_id)->get()[0];
            $startdt = \Carbon\Carbon::create($Quizzes->start);
            $enddt = \Carbon\Carbon::create(\Carbon\Carbon::now());
            $duration = $enddt->minute - $startdt->minute;
            $Quizzes->update([
                'total' => count($grade),
                'Quizze_duration' =>   $duration >= 0  ? $duration :  $duration + 60,
                'end' => \Carbon\Carbon::now()
            ]);
            // ------------------------------------------------------------

            return redirect()->route("questions.detailse", $request->quizze_id);
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route("questions.detailse")->with('error', '  يوجد خطأ في الاختبار يرجى المحاولة مرة اخرى ');
        }
    }


    public function show($id)
    {
        //
    }
    public function review($id)
    {
        try {
            $quizze = Quizzes::where('id', $id)->with('question')->get()[0];
            $quizze_question = [];
            foreach ($quizze['question'] as $key => $question) {
                $quizze_question[$key] = Quizzes_Question::where('Question_id', $question->Question_id)->with('answers')->get();
            }



            return view('admin.Student.Quizzes.review', compact('quizze_question'));
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route("questions.detailse")->with('error', '  يوجد خطأ في الاختبار يرجى المحاولة مرة اخرى ');
        }
    }
    public function detailse($id)
    {
        $quizze = Quizzes::where('id', $id)->get()[0];
        return view('admin.Student.Quizzes.detailse', compact('quizze'));
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
