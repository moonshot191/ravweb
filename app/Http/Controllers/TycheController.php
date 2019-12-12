<?php

namespace App\Http\Controllers;

use App\Exports\TycheExport;
use App\Tyche;
use DB;
use Illuminate\Http\Request;
use App\Authorizable;
use App\Imports\TycheImport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class TycheController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tyche $model)
    {
        return view('bot.tyche.index', ['tyche' => $model->orderBy('created_at', 'desc')->paginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bot.tyche.create');
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

            Excel::import(new TycheImport,request()->file('csv_file'));
            return redirect()->route('tyches.index')->withStatus(__('File uploaded.'));

        }else{
            return redirect()->route('tyches.create')->withStatus(__('File not a CSV.'));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tyche  $tyche
     * @return \Illuminate\Http\Response
     */
    public function show(Tyche $tyche)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tyche  $tyche
     * @return \Illuminate\Http\Response
     */
    public function edit(Tyche $tyche)
    {
        return view('bot.tyche.edit',compact('tyche'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tyche  $tyche
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tyche $tyche)
    {
        $rules = array(
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
        Tyche::whereId($tyche->id)->update($data);


        return redirect()->route('tyches.index')->withStatus(__('Question successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tyche  $tyche
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tyche $tyche)
    {
        $tyche->delete();

        return redirect()->route('tyches.index')->withStatus(__('Question successfully deleted.'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("tyches")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Question(s) Deleted successfully."]);
    }

    public function validateAll(Request $request){
        $ids = $request->ids;
        DB::table("tyches")->whereIn('id',explode(",",$ids))->update(array('validated'=>true,
            'validated_by'=>auth()->user()->username,'validated_at'=>\Carbon\Carbon::now()));
        return response()->json(['success'=>"Question(s) Validated successfully!"]);
    }

    public function export()
    {
        return Excel::download(new TycheExport, 'tyche.csv');
    }

    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/sample_odin.csv";

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return response()->download($file, 'sample_tyche.csv', $headers);
    }
}
