<?php

namespace KTS\Http\Controllers;

use Illuminate\Http\Request;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funds = self::me()->funds()->get();
        return view('funds.index', compact('funds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $alert = self::errorMessage(); 

        if($request->type && $request->amount) {
            $fund = self::me()->funds()->create(['type' => $request->type, 'amount' => $request->amount]);
            if($fund) $alert = ['type' => 'success', 'message' => 'Your entry was successfully added.'];
        }
        
        return redirect()->back()->with(['alert' => $alert]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alert = self::errorMessage(); 

        if($id) {
            $fund = self::me()->funds()->find($id)->delete();
            if($fund) $alert = ['type' => 'success', 'message' => 'Selected item was successfully deleted.'];
        }
        
        return redirect()->back()->with(['alert' => $alert]);        
    }

    public function me()
    {
        return auth()->user();
    }    

    private function errorMessage()
    {
        return ['type' => 'danger',  'message' => 'Something went wrong. Please contact admin.'];
    }        
}
