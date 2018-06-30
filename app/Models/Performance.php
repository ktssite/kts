<?php

namespace KTS\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = ['user_id', 'date', 'lot_size', 'pip', 'profit'];
    protected $appends  = ['year', 'month', 'week', 'day'];

    public function user()
    {
        return self::belongsTo('KTS\Models\User');
    }  


    public function setDateAttribute($value)
    {
    	return $this->attributes['date'] = date_create($value);
    }

    public function getDateAttribute($value)
    {
    	return is_string($value)? date_format(date_create($value), 'm/d/Y'): $value->format('m/d/Y');
    }


    /**
     * Mutate the value before saving to the database.
     */    
    public function setPipAttribute($value)
    {
        $this->attributes['pip'] = $value * config('app.decimal_places');
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
