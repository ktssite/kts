<?php

namespace KTS\Http\Controllers;

use Illuminate\Http\Request;
use KTS\Traits\UserTrait;

use KTS\Models\User;
use KTS\Models\Performance;

use DB;

class DashboardController extends Controller
{
	use UserTrait;

    private static $details = [];

    function __construct()
    {
        self::initalize();
    }

    public function index()
    {
        //Set Dasbhoards Details
        self::setAmounts();
    	self::setDailyRanking();
        self::setWeekRanking();
        self::setMonthlyRanking();

        return view('dashboards.index', self::$details['data']);
    }

    private function setAmounts()
    {
        $columns = ['available_equity', 'total_profits', 'total_deposits', 'total_withdrawals'];
        foreach ($columns as $column) {
            self::$details['data']['amounts'][$column] = _d(self::me()->$column);
        }
    }

    private function setDailyRanking()
    {
        self::$details['data']['daily_rankings'] = self::getBaseQuery()->where('p.date', self::$details['date'])->get();
    }

    private function setWeekRanking()
    {
        $rankings = self::getBaseQuery()->where(DB::raw("WEEK(p.date)"), self::$details['week'])->get();
        $users = [];
        $week = self::$details['week'];
        foreach ($rankings as $rank) {
            $users[$rank->id]['name']   = $rank->name;
            $users[$rank->id]['equity'] = $rank->equity + (isset($users[$rank->id]['equity'])? $users[$rank->id]['equity']: 0);
            $users[$rank->id]['date']   = $week;
        }

        self::$details['data']['weekly_rankings'] = $users;
    }

    private function setMonthlyRanking()
    {
        $rankings = self::getBaseQuery()->where(DB::raw("MONTH(p.date)"), self::$details['month'])->get();
        $users = [];
        $month = month(self::$details['month']);
        foreach ($rankings as $rank) {
            $users[$rank->id]['name']   = $rank->name;
            $users[$rank->id]['equity'] = $rank->equity + (isset($users[$rank->id]['equity'])? $users[$rank->id]['equity']: 0);
            $users[$rank->id]['date']   = $month;
        }

        self::$details['data']['monthly_rankings'] = $users;
    }

    private function getBaseQuery()
    {
        return User::select('users.id', 'p.date', 'users.name',
                     DB::raw("(p.profit + (select sum(IF(type='Deposit', amount, amount*-1)) as total_fund from funds where user_id = users.id)) as equity"))
                   ->role('Student')
                   ->join('performances as p', 'p.user_id', '=', 'users.id')
                   ->orderBy('equity', 'desc');
    }

    private function initalize()
    {
        $performance = User::select('p.date', DB::raw('WEEK(p.date) as week'), DB::raw('MONTH(p.date) as month'))
                           ->role('Student')
                           ->join('performances as p', 'p.user_id', '=', 'users.id')
                           ->latest('p.date')->first();        

        if($performance) {
            self::$details['date']  = $performance->date;
            self::$details['week']  = $performance->week;
            self::$details['month'] = $performance->month;
        } else {
            self::$details['date'] = self::$details['week'] = self::$details['month'] = null;
        }

    }
}
