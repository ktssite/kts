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

    public function getProfit($date, $type = 'day', $until = false)
    {
        $performances = self::hasMany('KTS\Models\Performance');
        $op           = ($until)? '<': '=';

        switch ($type) {
            case 'day':
                $profit = $performances->where('date', $op, dbDate($date))->sum('profit');
                break;
            case 'week':
                $week   = intval($date);
                $profit = $performances->whereRaw("week(date) $op $week")->sum('profit');

                break;            
            case 'month':
                $month  = intval($date);
                $profit = $performances->whereRaw("month(date) $op $month")->sum('profit');
                break;                            
            default:
                $profit = 0;
                break;
        }

        return $profit;
    }

    public function getFund($date = '', $type = 'day', $until = true)
    {
        $deposit  = self::funds()->where('type', 'Deposit');
        $withdraw = self::funds()->where('type', 'Withdraw');
        $op       = ($until)? '<': '=';

        if($until) {
            switch ($type) {
                case 'day':
                    $total = $deposit->whereDate('created_at', $op, dbDate($date))->sum('amount') -
                             $withdraw->whereDate('created_at', $op, dbDate($date))->sum('amount');
                    break;
                case 'week':
                    $week  = intval($date);
                    $total = $deposit->whereRaw("week(created_at) $op $week")->sum('amount') -
                             $withdraw->whereRaw("week(created_at) $op $week")->sum('amount');
                    break;
                case 'month':
                    $month = intval($date);
                    $total = $deposit->whereRaw("month(created_at) $op $month")->sum('amount') -
                             $withdraw->whereRaw("month(created_at) $op $month")->sum('amount');
                    break;
                default:
                    $total = 0;
                    break;
            }
        } else $total = $deposit->sum('amount') - $withdraw->sum('amount');
               
        return $total;  
    }

    public function getEquity($date = '', $type = 'day', $until = false)
    {

        $fund   = self::getFund($date, $type, $until);
        $profit = self::getProfit($date, $type, $until);
        
        return $fund + $profit;
    }

}

