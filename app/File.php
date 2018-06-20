<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Auth;

class File extends Model
{
    protected $fillable = [
        'account_id',
        'file',
        'file_type'
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
                $builder->where('files.account_id', Auth::user()->account_id);
            }
        });
    }

}
