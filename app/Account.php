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

}
