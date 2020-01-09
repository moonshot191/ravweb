<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Imports\NuwaImport;
use App\Nuwa;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Exports\NuwaExport;
class NuwaController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Nuwa $nuwa)
    {
        return view('bot.nuwa.index', ['nuwa' => $nuwa->orderBy('created_at', 'desc')->paginate(100)]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bot.nuwa.upload');
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

            Excel::import(new NuwaImport,request()->file('csv_file'));
            return redirect()->route('nuwas.index')->withStatus(__('File uploaded.'));

        }else{
            return redirect()->route('nuwas.create')->withStatus(__('File not a CSV.'));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nuwa  $nuwa
     * @return \Illuminate\Http\Response
     */
    public function show(Nuwa $nuwa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nuwa  $nuwa
     * @return \Illuminate\Http\Response
     */
    public function edit(Nuwa $nuwa)
    {
        return view('bot.nuwa.edit',compact('nuwa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nuwa  $nuwa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nuwa $nuwa)
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
        Nuwa::whereId($nuwa->id)->update($data);


        return redirect()->route('nuwas.index')->withStatus(__('Question successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nuwa  $nuwa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nuwa $nuwa)
    {
        $nuwa->delete();
        return redirect()->route('nuwas.index')->withStatus(__('Question successfully deleted.'));
    }

    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/quiz.csv";

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return response()->download($file, 'sample.csv', $headers);
    }

    public function import()
    {
        Excel::import(new NuwaImport,request()->file('csv_file'));

        return back();
    }

    public function export()
    {
        return Excel::download(new NuwaExport, 'nuwa.csv');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("nuwas")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Question(s) Deleted successfully."]);
    }

    public function validateAll(Request $request){
        $ids = $request->ids;
        DB::table("nuwas")->whereIn('id',explode(",",$ids))->update(array('validated'=>true,
            'validated_by'=>auth()->user()->username,'validated_at'=>\Carbon\Carbon::now()));
        return response()->json(['success'=>"Question(s) Validated successfully!"]);
    }
}
