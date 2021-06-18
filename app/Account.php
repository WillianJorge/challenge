<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agency',
        'number',
        'digit',
        'user_id',
        'company_id',
        'person_id'
    ];

    public function persons()
    {
        return $this->hasOne(Person::class, 'id','person_id');
    }

    public function companies()
    {
        return $this->hasOne(Companies::class, 'id','company_id');
    }

}
