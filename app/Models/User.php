<?php

namespace KTS\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

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
    protected $appends  = ['available_equity', 'total_funds', 'total_profits', 'total_deposits', 'total_withdrawals'];

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
        return self::hasMany('KTS\Models\Performance');
    }    

    public function funds()
    {
        return self::hasMany('KTS\Models\Fund');
    }  

    public function getTotalDepositsAttribute()
    {
        return self::funds()->where('type', 'Deposit')->sum('amount');
    }    

    public function getTotalWithdrawalsAttribute()
    {
        return self::funds()->where('type', 'Withdraw')->sum('amount');
    }    

    public function getTotalProfitsAttribute()
    {
        return self::hasMany('KTS\Models\Performance')->sum('profit');
    } 

    public function getAvailableEquityAttribute()
    {
        return $this->total_funds + $this->total_profits;
    }      

    public function getTotalFundsAttribute()
    {
        return $this->total_deposits - $this->total_withdrawals;
    } 

    public function getAvatar()
    {
        return ($this->profile_img) ? asset(Storage::url($this->profile_img)) : asset('images/profile.jpg'); 
    }

    public function getThumbnail()
    {
        $imgSrc = asset('images/default.jpg');
        if ($this->profile_img) {
            $partition = explode('/',$this->profile_img);
            $folder = $partition[0]. '/' .$partition[1];
            if (isset($partition[2])) {
                $file = $partition[2];
                $idx = strpos($file, '-');
                $imgSrc = 'thumb'. substr($file, $idx);
                $imgSrc = Storage::url($folder. '/' .$imgSrc);
            }
        }
        return $imgSrc;
    }

    public function getLatestProfitDate()
    {
        return _date(self::performances()->latest()->value('date'));
    }
}
