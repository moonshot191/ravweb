<?php

namespace App\Http\Controllers;

use App\Exports\LeiziExport;
use App\Imports\LeiziImport;
use App\Leizi;
use DB;
use Illuminate\Http\Request;
use App\Authorizable;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class LeiziController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Leizi $model)
    {
        return view('bot.leizi.index', ['leizi' => $model->orderBy('created_at', 'desc')->paginate(100)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bot.leizi.create',compact('groups'));
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

            Excel::import(new LeiziImport,request()->file('csv_file'));
            return redirect()->route('leizis.index')->withStatus(__('File uploaded.'));

        }else{
            return redirect()->route('leizis.index')->withStatus(__('File not a CSV.'));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leizi  $leizi
     * @return \Illuminate\Http\Response
     */
    public function show(Leizi $leizi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leizi  $leizi
     * @return \Illuminate\Http\Response
     */
    public function edit(Leizi $leizi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leizi  $leizi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leizi $leizi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leizi  $leizi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leizi $leizi)
    {
        $leizi->delete();

        return redirect()->route('leizi.index')->withStatus(__('Question successfully deleted.'));
    }


    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("leizis")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Question(s) Deleted successfully."]);
    }

    public function validateAll(Request $request){
        $ids = $request->ids;
        DB::table("leizis")->whereIn('id',explode(",",$ids))->update(array('validated'=>true,
            'validated_by'=>auth()->user()->username,'validated_at'=>\Carbon\Carbon::now()));
        return response()->json(['success'=>"Question(s) Validated successfully!"]);
    }

    public function export()
    {
        return Excel::download(new LeiziExport, 'leizi.csv');
    }

    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/sample_leizi.csv";

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return response()->download($file, 'sample_leizi.csv', $headers);
    }
}
