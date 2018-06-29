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
        self::setAmounts();
    	self::setDailyRanking();
        self::setWeeklyRanking();
        self::setMonthlyRanking();
        self::setEquitySummary();

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
        self::$details['data']['daily_rankings'] = self::getUsers()->each(function($user) {
            $profit_today       = $user->performances()->where('date', self::$details['date'])->value('profit');
            $equity_yesterday   = $user->available_equity - $profit_today;
            $user->daily_change = ($profit_today)? pround(($profit_today / $equity_yesterday) * 100): 0;
            $user->date         = _date(self::$details['date']);
        })->sortByDesc('daily_change');
    }

    private function setWeeklyRanking()
    {
        self::$details['data']['weekly_rankings'] = self::getUsers()->each(function($user) {
            $profit_this_week    = $user->performances()->where(DB::raw("WEEK(date)"), self::$details['week'])->value('profit');
            $equity_last_week    = $user->available_equity - $profit_this_week;
            $user->weekly_change = ($profit_this_week)? pround(($profit_this_week / $equity_last_week) * 100): 0;
            $user->week          = self::$details['week'];
        })->sortByDesc('weekly_change');
    }

    private function setMonthlyRanking()
    {
        self::$details['data']['monthly_rankings'] = self::getUsers()->each(function($user) {
            $profit_this_month    = $user->performances()->where(DB::raw("WEEK(date)"), self::$details['week'])->value('profit');
            $equity_last_month    = $user->available_equity - $profit_this_month;
            $user->monthly_change = ($profit_this_month)? pround(($profit_this_month / $equity_last_month) * 100): 0;
            $user->month          = month(self::$details['month']);
        })->sortByDesc('monthly_change');
    }

    private function setEquitySummary()
    {
        self::$details['data']['equity_summary'] = self::getUsers()->sortByDesc('available_equity');
    }

    private function getUsers()
    {
        return User::role('Student')->get();
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
