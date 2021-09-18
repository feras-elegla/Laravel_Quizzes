<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizzes_Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'Quizze_id',
        'Question_id',
        'iscorrect',
        'Question_title',
        'student_answer',
        'correct_answer',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function scopeSelection($query)
    {
        return $query->select(

            'id',
            'Quizze_id',
            'Question_id',
            'Question_title',
            'iscorrect',
            'student_answer',
            'correct_answer',



        );
    }
    public function answers(){
        return $this->hasMany('App\Models\Answer', 'question_id', 'Question_id');
    }

}
