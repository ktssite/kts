<?php

namespace KTS\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = ['user_id', 'date', 'profit'];
	protected $casts    = ['date' => 'datetime:Y-m-d'];
    const DECIMAL       = 100; //Two decimal places

    public function setDateAttribute($value)
    {
    	return $this->attributes['date'] = date_create($value);
    }

    public function getDateAttribute($value)
    {
    	return is_string($value)? date_format(date_create($value), 'm/d/Y'): $value->format('m/d/Y');
    }

    public function setProfitAttribute($value)
    {
    	$this->attributes['profit'] = $value * self::DECIMAL;
    }    

    public function d_profit($value)
    {
    	return $value / self::DECIMAL;
    }        


}
