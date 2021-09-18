<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizzes extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'User_id',
        'category_id',
        'No_Question',
        'Quizze_duration',
        'total',
        'start',
        'end',
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
            'User_id',
            'category_id',
            'No_Question',
            'Quizze_duration',
            'total',
            'start',
            'end',


        );
    }
    public function question(){
        return $this->hasMany('App\Models\Quizzes_Question', 'Quizze_id', 'id');

    }
}
