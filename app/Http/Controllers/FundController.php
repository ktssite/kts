<?php

namespace KTS\Http\Controllers;

use Illuminate\Http\Request;
use KTS\Traits\UserTrait;

class FundController extends Controller
{
    use UserTrait;

    public function index(Request $request)
    {
        $filter = $request->d;
        $funds = self::me()->funds();

        if($filter == 'Withdraw') $funds = $funds->where('type', 'Withdraw');
        if($filter == 'Deposit')  $funds = $funds->where('type', 'Deposit');

        $funds = $funds->get();
        return view('funds.index', compact('funds'));
    }

    public function store(Request $request)
    {
        $alert = self::errorMessage(); 

        if($request->type && $request->amount > 0 && $request->date) {
            $fund = self::me()->funds()->create(['type' => $request->type, 'amount' => $request->amount, 'date' => $request->date]);
            if($fund) $alert = ['type' => 'success', 'message' => 'Your entry was successfully added.'];
        } elseif($request->amount <= 0) {
            $alert = ['type' => 'warning', 'message' => 'Amount should be greater than 0.'];
        }
        
        return redirect()->back()->with(['alert' => $alert]);
    }

    public function update(Request $request, $id)
    {
        $alert = self::errorMessage(); 

        if($request->e_amount <= 0) {
            $alert = ['type' => 'warning', 'message' => 'Amount should be greater than 0.'];
        } else {
            if($request->fid && $request->e_date) {
                $data = [
                    'date'   => $request->e_date,
                    'amount' => $request->e_amount
                ];

                $fund = self::me()->funds()->find($request->fid)->update($data);
                if($fund) $alert = ['type' => 'success', 'message' => 'Your entry was successfully updated.'];
            }
        }

        
        return redirect()->back()->with(['alert' => $alert]);
    }

    public function destroy($id)
    {
        $alert = self::errorMessage(); 

        if($id) {
            $fund = self::me()->funds()->find($id)->delete();
            if($fund) $alert = ['type' => 'success', 'message' => 'Fund was successfully deleted.'];
        }
        
        return redirect()->back()->with(['alert' => $alert]);        
    }     
}
