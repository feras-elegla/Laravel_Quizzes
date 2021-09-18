<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'type',
        'parent_id',
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
            'name',
            'type',
            'parent_id',


        );
    }
    public function questions(){
        return $this->hasMany('App\Models\Question', 'category_id', 'id');
    }
}
