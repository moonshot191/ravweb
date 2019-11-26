<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Group;
use App\Zalmo;
use Illuminate\Http\Request;
use App\Exports\ZalmoExport;
use App\Imports\ZalmoImport;
use Maatwebsite\Excel\Facades\Excel;

use Validator;
class ZalmoController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Zalmo $model)
    {
        return view('bot.zalmo.index', ['zalmo' => $model->orderBy('created_at', 'desc')->paginate(10)]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('bot.zalmo.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt',

        ]);
        if ($validator->passes()) {

            Excel::import(new ZalmoImport,request()->file('csv_file'));
            return redirect()->route('zalmos.index')->withStatus(__('File uploaded.'));

        }else{
                    return redirect()->route('zalmos.create')->withStatus(__('File not a CSV.'));

                }


        }


    public function import()
    {
        Excel::import(new ZalmoImport,request()->file('csv_file'));

        return back();
    }

    public function export()
    {
        return Excel::download(new ZalmoExport, 'zalmoxis.csv');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Zalmo  $zalmo
     * @return \Illuminate\Http\Response
     */
    public function show(Zalmo $zalmo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zalmo  $zalmo
     * @return \Illuminate\Http\Response
     */
    public function edit(Zalmo $zalmo)
    {
        return view('bot.zalmo.edit',compact('zalmo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zalmo  $zalmo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zalmo $zalmo)
    {
        $rules = array(
            'answer'=>'required|string|min:3',
            'level' => 'required|numeric',
        );
        $this->validate($request,$rules);
        $data = request()->except(['_token','_method']);
        if(isset($data['validated'])){

            $data['validated']=true;
            $data['validated_by']=auth()->user()->username;
            $data['validated_at']=\Carbon\Carbon::now();
        }else{
            $data['validated']=false;
        }
        $data['edited_by']=auth()->user()->username;
        Zalmo::whereId($zalmo->id)->update($data);


        return redirect()->route('zalmos.index')->withStatus(__('Question successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zalmo  $zalmo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zalmo $zalmo)
    {
        $zalmo->delete();
        return redirect()->route('zalmos.index')->withStatus(__('Question successfully deleted.'));
    }

}
