<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Course extends Model
{

    protected $fillable = [
        'account_id',
        'category_id',
        'level_id',
        'name',
        'description',
        'objective',
        'requisites',
        'audience',
        'type_sale',
        'price',
        'certificate',
        'video_apresentation',
        'image_apresentation'
    ];

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('active', function (Builder $builder){
            if(Auth::check()){
                $builder->where('courses.account_id', Auth::user()->account_id);
            }
        });
    }

}
