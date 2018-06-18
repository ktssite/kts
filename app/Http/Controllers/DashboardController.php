<?php

namespace KTS\Http\Controllers;

use Illuminate\Http\Request;
use KTS\Traits\UserTrait;

class DashboardController extends Controller
{
	use UserTrait;

    public function index()
    {
    	$amounts = [
    		'available_equity'  => _d(self::me()->available_equity),
    		'tota_profits'      => _d(self::me()->total_profits),
    		'total_deposits'    => _d(self::me()->total_deposits),
    		'total_withdrawals' => _d(self::me()->total_withdrawals)
    	];

    	// $rankings = 
        return view('dashboards.index', compact('amounts'));
    }
}
