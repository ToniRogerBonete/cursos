<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Response extends Model
{
    protected $fillable = [
        'account_id',
        'question_id',
        'response'
    ];

    protected $hidden = [
        'account_id'
    ];

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('active', function (Builder $builder){
            if(Auth::check()){
                $builder->where('responses.account_id', Auth::user()->account_id);
            }
        });
    }
}
