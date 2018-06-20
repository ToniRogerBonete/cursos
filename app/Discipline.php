<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Discipline extends Model
{
    protected $fillable = [
        'account_id',
        'name',
        'price',
        'minimun_time',
        'ordem'
    ];

    protected $hidden = [
        'account_id'
    ];

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function contents()
    {
        return $this->hasMany('App\Content')
            ->orderBy('ordem','ASC');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('active', function (Builder $builder){
            if(Auth::check()){
                $builder->where('disciplines.account_id', Auth::user()->account_id);
            }
        });
    }
}
