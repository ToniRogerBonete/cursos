<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Question extends Model
{
    protected $fillable = [
        'account_id',
        'content_id',
        'question'
    ];

    protected $hidden = [
        'account_id'
    ];

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function responses()
    {
        return $this->hasMany('App\Response')
            ->orderBy('id','DESC');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('active', function (Builder $builder){
            if(Auth::check()){
                $builder->where('questions.account_id', Auth::user()->account_id);
            }
        });
    }
}
