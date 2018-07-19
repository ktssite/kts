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
    	$profit = $user->getProfit($date, $type, false);
    	$equity = $user->getEquity($date, $type, true);
        $prev_e = $equity - $profit;
        
    	return ($prev_e)? pround(($profit / $prev_e) * 100): 0;
    }
}