<?php

namespace KTS\Http\Controllers;

use Illuminate\Http\Request;
use KTS\Traits\UserTrait;
use KTS\Models\User;
use KTS\Models\Performance;

use DB;

class PerformanceController extends Controller
{
    use UserTrait;

    public function index(Request $request)
    {
        // dd(monthNum('2018-07-02'));
        $performances      = self::me()->performances()->orderBy('date')->get();
        $group_performance = self::getGroupPerformance($request);
        $students          = User::role('Student')->get();

        //Initializations
        $performances = self::mergeSameDayPerformance($performances);
        $prev_month   = $prev_week = '';
        $user         = self::me();

        // dd($performances);
        foreach ($performances as $key => $p) {
            if($prev_month != $p->month) { $prev_month = $p->month; $m = 1; }
            if($prev_week  != $p->week)  { $prev_week  = $p->week;  $w = 1; }
            if($w == 1) { $p->w_col = true; $key_w = $key; } else $p->w_col = false;
            if($m == 1) { $p->m_col = true; $key_m = $key; } else $p->m_col = false;

            $performances[$key_w]->rs_w = $w;
            $performances[$key_m]->rs_m = $m;            

            $p->equity       = $user->getEquity($p->date, 'day', true);
            $p->profit       = $user->getProfit($p->date, 'day', false);
            $p->daily_change = self::getChange($user, $p->date, 'day');

            if(!isset($performances[$key_w]->weekly_change))
                $performances[$key_w]->weekly_change  = self::getChange($user, $p->week, 'week');

            if(!isset($performances[$key_m]->monthly_change))
                $performances[$key_m]->monthly_change = self::getChange($user, $p->month, 'month');

            $w++; $m++;
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
        $from = ($request->from? dbDate($request->from): date("Y-m-d"));
        $to   = ($request->to?   dbDate($request->to): '');
        $student_ids  = (array) $request->s;

        $performances = ($from && $to && $from <= $to)? 
                        Performance::whereBetween('date', [$from, $to]): 
                        Performance::where('date', $from);

        if(count($student_ids)) $performances = $performances->whereIn('user_id', $student_ids);

        $merged_performances = self::mergeSameDayPerformance($performances->orderBy('user_id')->get());


        foreach ($merged_performances as $p) {
            $user = User::find($p->user_id);
            $p->equity = $user->getEquity($p->date, 'day', true);
            $p->profit = $user->getProfit($p->date, 'day', false);
        }

        return $merged_performances;

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
