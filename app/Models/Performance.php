<?php

namespace KTS\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    const DECIMAL       = 100; //Two decimal places

    protected $fillable = ['user_id', 'date', 'profit'];
	protected $casts    = ['date' => 'datetime:Y-m-d'];
    protected $appends  = ['year', 'month', 'week', 'day'];


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

    /**
     * Append customer columns based on date
     */
	public function getYearAttribute()
	{
	    return date('Y', strtotime($this->date));
	}   

	public function getMonthAttribute()
	{
	    return date('F', strtotime($this->date));
	} 

	public function getWeekAttribute()
	{
	    return date('W', strtotime($this->date));
	}  	 

	public function getDayAttribute()
	{
	    return date('l', strtotime($this->date));
	}		
}
