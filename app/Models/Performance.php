<?php

namespace KTS\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = ['user_id', 'date', 'profit'];
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
    	$this->attributes['profit'] = $value * config('app.decimal_places');
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
