<?php

namespace KTS\Http\Controllers;

use Illuminate\Http\Request;
use KTS\Traits\UserTrait;
use KTS\Models\User;
use KTS\Models\Performance;

class PerformanceController extends Controller
{
    use UserTrait;

    public function index(Request $request)
    {
        $performances      = self::me()->performances()->orderBy('date')->get();
        $group_performance = self::getGroupPerformance($request);
        $students          = User::role('Student')->get();

        //Initializations
        $performances = self::mergeSameDayPerformance($performances);
        $prev_month   = $prev_week = '';
        $equity       = $prev_equity_daily 
                      = self::me()->total_funds;

        foreach ($performances as $key => $value) {
            if($prev_month != $value->month) { $prev_month = $value->month; $m = 1; }
            if($prev_week  != $value->week)  { $prev_week  = $value->week;  $w = 1; }

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
            $performances[$key_w]->rs_w           = $w;
            $performances[$key_m]->rs_m           = $m;            

            $w++; 
            $m++;
            $prev_equity_daily = $equity;
        }

        return view('performances.index', compact('performances', 'group_performance', 'students'));
    }

    public function store(Request $request)
    {
        $alert = self::errorMessage(); 
        $input = $request->except('_token');

        if($input['date'] && $input['lot_size'] && $input['pip'] && $input['profit'] && $input['instrument']) {
            $performance = self::me()->performances()->create($input);
            if($performance) $alert = ['type' => 'success', 'message' => 'Your entry was successfully added.'];
        }
        
        return redirect()->back()->with(['alert' => $alert]);
    }

    public function update(Request $request, $id)
    {
        $alert = self::errorMessage(); 

        if($request->pid && $request->e_date && $request->e_instrument) {
            $data = [
                'date'       => $request->e_date,
                'lot_size'   => $request->e_lot_size,
                'pip'        => $request->e_pip,
                'instrument' => $request->e_instrument,
                'profit'     => $request->e_profit
            ];

            $performance = self::me()->performances()->find($request->pid)->update($data);
            if($performance) $alert = ['type' => 'success', 'message' => 'Your entry was successfully updated.'];
        }
        
        return redirect()->back()->with(['alert' => $alert]);
    }

    public function destroy($id)
    {
        $alert = self::errorMessage(); 

        if($id) {
            $performance = self::me()->performances()->find($id)->delete();
            if($performance) $alert = ['type' => 'success', 'message' => 'Selected item was successfully deleted.'];
        }
        
        return redirect()->back()->with(['alert' => $alert]);

    }

    private function calculateProfit($change, $value)
    {
        if($value > 0) return pround(($change / $value) * 100);
        return 0;
    }

    private function getGroupPerformance($request)
    {  
        $date         = $request->has('d')? date_format(date_create($request->d), 'Y-m-d'): date("Y-m-d");
        $student_ids  = (array) $request->s;
        $performances = Performance::where('date', $date);

        if(count($student_ids)) $performances = $performances->whereIn('user_id', $student_ids);
        return self::mergeSameDayPerformance($performances->get());

    }

    private function mergeSameDayPerformance($performances)
    {
        $cp = []; $prev_date = $prev_uid = ''; $key = -1;

        foreach ($performances as $p) {
            if($prev_date != $p->date || $prev_uid != $p->user_id) { 
                if($prev_date != $p->date )   $prev_date = $p->date; 
                if($prev_uid  != $p->user_id) $prev_uid  = $p->user_id; 
                $key++; 
            } 

            if(!isset($cp[$key])) $cp[$key] = new \stdClass();

            foreach (['user_id', 'year', 'month', 'week', 'day', 'date'] as $column) {
                $cp[$key]->$column = $p->$column;            
            }

            $cp[$key]->student = $p->user->name;
            $cp[$key]->profit  = $p->user->getDailyProfit(dbDate($p->date));
            $cp[$key]->equity  = $p->user->available_equity;
            $cp[$key]->details[] = [
                'id'         => $p->id, 
                'instrument' => $p->instrument,
                'lot_size'   => $p->lot_size,
                'pip'        => $p->pip,
                'profit'     => $p->profit
            ];           
        }

        return $cp;
    }
}
