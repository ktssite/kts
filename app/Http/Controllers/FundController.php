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

        if($request->type && $request->amount) {
            $fund = self::me()->funds()->create(['type' => $request->type, 'amount' => $request->amount]);
            if($fund) $alert = ['type' => 'success', 'message' => 'Your entry was successfully added.'];
        }
        
        return redirect()->back()->with(['alert' => $alert]);
    }

    public function update(Request $request, $id)
    {
        //
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

    // public function me()
    // {
    //     return auth()->user();
    // }    

    // private function errorMessage()
    // {
    //     return ['type' => 'danger',  'message' => 'Something went wrong. Please contact admin.'];
    // }        
}
