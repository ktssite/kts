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

    public function index(Request $request)
    {
        self::initalize($request->all());
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
            self::$details['data']['amounts']['student'][$column] = _d(self::me()->$column);
            self::$details['data']['amounts']['admin'][$column]   = _d(self::$details['admin']->$column);
        }
    }

    private function setDailyRanking()
    {
        self::$details['data']['daily_rankings'] = self::getUsers()->each(function($user) {
            $profit_today       = $user->getDailyProfit(self::$details['data']['date']);
            $equity_yesterday   = $user->available_equity - $profit_today;
            $user->daily_change = ($profit_today && $equity_yesterday)? pround(($profit_today / $equity_yesterday) * 100): 0;
            $user->date         = _date(self::$details['data']['date']);
        })->sortByDesc('daily_change');
    }

    private function setWeeklyRanking()
    {
        self::$details['data']['weekly_rankings'] = self::getUsers()->each(function($user) {
            $profit_this_week    = $user->performances()->where(DB::raw("WEEK(date)"), self::$details['data']['week'])->value('profit');
            $equity_last_week    = $user->available_equity - $profit_this_week;
            $user->weekly_change = ($profit_this_week && $equity_last_week)? pround(($profit_this_week / $equity_last_week) * 100): 0;
            $user->week          = self::$details['data']['week'];
        })->sortByDesc('weekly_change');
    }

    private function setMonthlyRanking()
    {
        self::$details['data']['monthly_rankings'] = self::getUsers()->each(function($user) {
            $profit_this_month    = $user->performances()->where(DB::raw("WEEK(date)"), self::$details['data']['week'])->value('profit');
            $equity_last_month    = $user->available_equity - $profit_this_month;
            $user->monthly_change = ($profit_this_month && $equity_last_month)? pround(($profit_this_month / $equity_last_month) * 100): 0;
            $user->month          = month(self::$details['data']['month']);
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

    private function initalize($input)
    {
        self::$details['data']['date']  = isset($input['d'])? $input['d']: date('m/d/Y');
        self::$details['data']['week']  = isset($input['w'])? $input['w']: date('W');
        self::$details['data']['month'] = isset($input['m'])? $input['m']: date('m');

        //Set admin user
        self::$details['admin'] = User::role('Admin')->first();

    }
}
