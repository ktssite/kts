<?php

namespace KTS\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasRoles;
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates    = ['deleted_at'];
    protected $appends  = ['equity'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'trading_day'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function performances()
    {
        return $this->hasMany('KTS\Models\Performance');
    }    

    public function funds()
    {
        return $this->hasMany('KTS\Models\Fund');
    }  

    public function getEquityAttribute()
    {
        $deposit  = self::funds()->where('type', 'Deposit')->sum('amount');
        $withdraw = self::funds()->where('type', 'Withdraw')->sum('amount');
        return $deposit - $withdraw;
    }      
}
