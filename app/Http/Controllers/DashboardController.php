<?php

namespace KTS\Http\Controllers;

use Illuminate\Http\Request;
use KTS\Traits\UserTrait;

use KTS\Models\User;
use KTS\Models\Performance;

class DashboardController extends Controller
{
	use UserTrait;

    public function index()
    {
    	$data = [];
    	$data['amounts'] = [
    		'available_equity'  => _d(self::me()->available_equity),
    		'tota_profits'      => _d(self::me()->total_profits),
    		'total_deposits'    => _d(self::me()->total_deposits),
    		'total_withdrawals' => _d(self::me()->total_withdrawals)
    	];

    	$data['daily_rankings'] = self::getDailyRanking();

        return view('dashboards.index', $data);
    }

    private function getDailyRanking()
    {
    	$ranks       = [];
    	$latest_date = self::getLatestPerformanceDate();

    	if($latest_date) {
    		$users = User::role('Student')
    					 ->select('users.*', 'p.date')
    		             ->leftjoin('performances as p', 'p.user_id', '=', 'users.id')
    		             ->where('p.date', $latest_date)
    				     ->get();

			$users = $users->sortByDesc(function($user){
			    return $user->available_equity;
			});

	    	foreach ($users as $user) {
	    		if($user->performances()->where('date', $latest_date)->exists()) {
	    			$ranks[] = [
	    				'name'             => $user->name,
	    				'available_equity' => _d($user->available_equity),
	    				'date'             => $latest_date
	    			];
	    		}
	    	}
    	}

    	return $ranks;
    	 
    }

    private function getLatestPerformanceDate()
    {
    	$max = User::role('Student')
    			   ->select('p.date')
    	           ->join('performances as p', 'p.user_id', '=', 'users.id')
    			   ->latest('p.date')->first();

    	return isset($max->date)? $max->date: null;
    }
}
