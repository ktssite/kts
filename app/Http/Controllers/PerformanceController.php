<?php

namespace KTS\Http\Controllers;

use Illuminate\Http\Request;
use KTS\Traits\UserTrait;

class PerformanceController extends Controller
{
    use UserTrait;

    public function index()
    {
        $performances = self::me()->performances()->orderBy('date')->get();

        //Initializations
        $equity = $prev_equity_daily 
                = self::me()->total_funds;
        $w = $m = 1; 

        foreach ($performances as $key => $value) {
            if($w == 1) {
                $performances[$key]->w_col    = true;
                $prev_equity_weekly           = $equity;
                $key_w                        = $key;
            } else $performances[$key]->w_col = false;

            if($m == 1) {
                $performances[$key]->m_col    = true;
                $prev_equity_monthly          = $equity;
                $key_m                        = $key;
            } else $performances[$key]->m_col = false;

            //Calculate daily equity.
            $equity += $value->profit;
            
            //Calculate weekly & monthly profits
            $weekly_profit  = $equity - $prev_equity_weekly;
            $monthly_profit = $equity - $prev_equity_monthly;

            $performances[$key]->equity           = _d($equity);
            $performances[$key]->daily_change     = self::calculateProfit($value->profit,  $prev_equity_daily);
            $performances[$key_w]->weekly_change  = self::calculateProfit($weekly_profit,  $prev_equity_weekly);
            $performances[$key_m]->monthly_change = self::calculateProfit($monthly_profit, $prev_equity_monthly);

            $w = ($w == 5)?  1: $w + 1; 
            $m = ($m == 30)? 1: $m + 1;
            $prev_equity_daily = $equity;
        }

        return view('performances.index', compact('performances'));
    }

    public function store(Request $request)
    {
        $alert = self::errorMessage(); 

        $input = $request->all();
        if($input['profit'] && $input['date']) {
            //check for duplicate date. Do not allow if it's already added.
            if(self::me()->performances()->where('date', dbDate($input['date']))->exists()) {
                $alert = ['type' => 'warning', 'message' => 'An entry with the same date already exist. You may just update it.'];
            } else {
                $performance = self::me()->performances()->create(['date' => $input['date'], 'profit' => $input['profit']]);
                if($performance) $alert = ['type' => 'success', 'message' => 'Your entry was successfully added.'];
            }
        }
        
        return redirect()->back()->with(['alert' => $alert]);
    }

    public function update(Request $request, $id)
    {
        $alert = self::errorMessage(); 

        if($request->pid && $request->e_date && $request->e_date) {
            $performance = self::me()->performances()->find($request->pid)->update(['date' => $request->e_date, 'profit' => $request->e_profit]);
            if($performance) $alert = ['type' => 'success', 'message' => 'Your entry was successfully updated.'];
        }
        
        return redirect()->back()->with(['alert' => $alert]);
    }

    public function destroy(Request $request, $id)
    {
        $alert = self::errorMessage(); 

        if($request->selected_items) {
            $performance = self::me()->performances()->whereIn('id', (array)$request->selected_items)->delete();
            if($performance) $alert = ['type' => 'success', 'message' => 'Selected item was successfully deleted.'];
        }
        
        return redirect()->back()->with(['alert' => $alert]);

    } 

    private function calculateProfit($change, $value)
    {
        if($value > 0) return pround(($change / $value) * 100);
        return 0;
    }
}
