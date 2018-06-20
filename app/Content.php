<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Content extends Model
{
    protected $fillable = [
        'account_id',
        'discipline_id',
        'name',
        'type',
        'ordem'
    ];

    protected $hidden = [
        'account_id',
    ];

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function questions()
    {
        return $this->hasMany('App\Question')
            ->orderBy('id','DESC');
    }

    public function documents()
    {
        return $this->hasMany('App\Document')
            ->orderBy('id','DESC');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('active', function (Builder $builder){
            if(Auth::check()){
                $builder->where('contents.account_id', Auth::user()->account_id);
            }
        });
    }
}
