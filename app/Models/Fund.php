<?php

namespace KTS\Models;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    protected $fillable = ['user_id', 'type', 'amount'];
    protected $dates = ['created_at'];

    public function setAmountAttribute($value)
    {
    	$this->attributes['amount'] = $value * config('app.decimal_places');
    }     
}
