<?php

namespace KTS\Traits;

trait UserTrait
{
    private function me()
    {
        return auth()->user();
    }    

    private function errorMessage()
    {
        return ['type' => 'danger',  'message' => 'Something went wrong. Please contact admin.'];
    } 

    private function getChange($user, $date, $type = 'day')
    {          
    	$profit      = $user->getProfit($date, $type);
    	$equity      = $user->getEquity($date, $type, true);
    	$prev_equity = $equity - $profit;

    	return ($equity)? pround(($profit / $equity) * 100): 0;
    }
}