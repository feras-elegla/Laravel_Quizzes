<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'correct_ansowre',
        'category_id',
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
            'title',
            'correct_ansowre',
            'category_id',



        );
    }
    public function answers(){
        return $this->hasMany('App\Models\Answer', 'question_id', 'id');
    }
}

