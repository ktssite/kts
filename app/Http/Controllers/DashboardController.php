<?php

namespace KTS\Http\Controllers;

use Illuminate\Http\Request;
use KTS\Traits\UserTrait;

use KTS\Models\User;
use KTS\Models\Performance;

class DashboardController extends Controller
{
	use UserTrait;

    private static $details = [];

    public function index(Request $request)
    {
        self::initalize($request->all());
        self::setAmounts();
        self::setRankings();
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

    private function setRankings()
    {
        foreach (['day', 'week', 'month'] as $type) {
            self::$details['data'][$type.'_rankings'] = self::getUsers()->each(function($user) use ($type) {

                $col = "{$type}_change";
                $user->$col  = self::getChange($user, self::$details['data'][$type], $type);
                $user->$type = ($type == 'day')? _date(self::$details['data'][$type]): self::$details['data'][$type];
            })->sortByDesc($type.'_change');
        }  
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
        self::$details['data']['day']   = isset($input['d'])? $input['d']: date('m/d/Y');
        self::$details['data']['week']  = isset($input['w'])? $input['w']: date('W');
        self::$details['data']['month'] = isset($input['m'])? $input['m']: date('m');

        //Set admin user
        self::$details['admin'] = User::role('Admin')->first();

    }
}
