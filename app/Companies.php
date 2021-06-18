<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'trading_name',
        'cnpj',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'company_id');
    }
}
