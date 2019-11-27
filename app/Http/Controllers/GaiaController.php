<?php

namespace App\Http\Controllers;

use App\Gaia;
use App\Imports\GaiaImport;
use App\Exports\GaiaExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class GaiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Gaia $model)
    {
        return view('bot.gaia.index', ['gaia' => $model->orderBy('created_at', 'desc')->paginate(10)]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bot.gaia.create');
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

            Excel::import(new GaiaImport,request()->file('csv_file'));
            return redirect()->route('gaias.index')->withStatus(__('File uploaded.'));

        }else{
            return redirect()->route('gaias.create')->withStatus(__('File not a CSV.'));

        }
    }


    public function export()
    {
        return Excel::download(new GaiaExport, 'gaia.csv');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gaia  $gaia
     * @return \Illuminate\Http\Response
     */
    public function show(Gaia $gaia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gaia  $gaia
     * @return \Illuminate\Http\Response
     */
    public function edit(Gaia $gaia)
    {
        return view('bot.gaia.edit',compact('gaia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gaia  $gaia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gaia $gaia)
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
        Gaia::whereId($gaia->id)->update($data);


        return redirect()->route('gaias.index')->withStatus(__('Question successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gaia  $gaia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gaia $gaia)
    {
        $gaia->delete();
        return redirect()->route('gaias.index')->withStatus(__('Question successfully deleted.'));
    }
}
