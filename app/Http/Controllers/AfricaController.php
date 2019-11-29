<?php

namespace App\Http\Controllers;

use App\Africa;
use Illuminate\Http\Request;
use App\Imports\AfricaImport;
use App\Exports\AfricaExport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
class AfricaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Africa $model)
    {
        return view('bot.africa.index', ['africa' => $model->orderBy('created_at', 'desc')->paginate(50)]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bot.africa.create');
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

            Excel::import(new AfricaImport,request()->file('csv_file'));
            return redirect()->route('africas.index')->withStatus(__('File uploaded.'));

        }else{
            return redirect()->route('africas.create')->withStatus(__('File not a CSV.'));

        }
    }


    public function export()
    {
        return Excel::download(new AfricaExport, 'africa.csv');
    }

    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/africa_sample.csv";

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return response()->download($file, 'sample_africa.csv', $headers);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Africa  $africa
     * @return \Illuminate\Http\Response
     */
    public function show(Africa $africa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Africa  $africa
     * @return \Illuminate\Http\Response
     */
    public function edit(Africa $africa)
    {
        return view('bot.africa.edit',compact('africa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Africa  $africa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Africa $africa)
    {
        $rules = array(
            'answer'=>'required|string|min:3',
            'question'=>'required|string|min:3',
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
        Africa::whereId($africa->id)->update($data);


        return redirect()->route('africas.index')->withStatus(__('Question successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Africa  $africa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Africa $africa)
    {
        $africa->delete();
        return redirect()->route('africas.index')->withStatus(__('Question successfully deleted.'));
    }
}
