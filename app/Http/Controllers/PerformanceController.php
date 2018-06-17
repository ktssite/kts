<?php

namespace KTS\Http\Controllers;

use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function me()
    {
        return auth()->user();
    }


    public function index()
    {
        $performances = self::me()->performances()->get();

        $equity = self::me()->equity;
        $w = $m = 1; 
        foreach ($performances as $key => $value) {
            $equity += $value->profit;
            $performances[$key]->equity = _d($equity);
            $performances[$key]->w_col  = ($w == 1) ? true: false;
            $performances[$key]->m_col  = ($m == 1) ? true: false;

            $w = ($w == 5)?  1: $w + 1; 
            $m = ($m == 30)? 1: $m + 1;
        }

        return view('performance.index', compact('performances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('performance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $alert = ['type' => 'danger',  'message' => 'Something went wrong. Please contact admin.']; 

        if($request->date && $request->date) {
            $performance = self::me()->performances()->create(['date' => $request->date, 'profit' => $request->profit]);
            if($performance) $alert = ['type' => 'success', 'message' => 'Your entry was successfully added.'];
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
    public function destroy(Request $request, $id)
    {
        $alert = ['type' => 'danger',  'message' => 'Something went wrong. Please contact admin.']; 

        if($request->selected_items) {
            $performance = self::me()->performances()->whereIn('id', (array)$request->selected_items)->delete();
            if($performance) $alert = ['type' => 'success', 'message' => 'Selected item was successfully deleted.'];
        }
        
        return redirect()->back()->with(['alert' => $alert]);

    }
}
