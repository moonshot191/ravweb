<?php

namespace App\Http\Controllers;


use App\Exports\OdinExport;
use App\Odin;
use DB;
use Illuminate\Http\Request;
use App\Authorizable;
use App\Imports\OdinImport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class OdinController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Odin $model)
    {
        return view('bot.odin.index', ['odin' => $model->orderBy('created_at', 'desc')->paginate(50)]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bot.odin.create');
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

            Excel::import(new OdinImport,request()->file('csv_file'));
            return redirect()->route('odins.index')->withStatus(__('File uploaded.'));

        }else{
            return redirect()->route('odins.create')->withStatus(__('File not a CSV.'));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Odin  $odin
     * @return \Illuminate\Http\Response
     */
    public function show(Odin $odin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Odin  $odin
     * @return \Illuminate\Http\Response
     */
    public function edit(Odin $odin)
    {
        return view('bot.odin.edit',compact('odin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Odin  $odin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Odin $odin)
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
        Odin::whereId($odin->id)->update($data);


        return redirect()->route('odins.index')->withStatus(__('Question successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Odin  $odin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Odin $odin)
    {
        $odin->delete();

        return redirect()->route('odins.index')->withStatus(__('Question successfully deleted.'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("odins")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Question(s) Deleted successfully."]);
    }

    public function validateAll(Request $request){
        $ids = $request->ids;
        DB::table("odins")->whereIn('id',explode(",",$ids))->update(array('validated'=>true,
            'validated_by'=>auth()->user()->username,'validated_at'=>\Carbon\Carbon::now()));
        return response()->json(['success'=>"Question(s) Validated successfully!"]);
    }

    public function export()
    {
        return Excel::download(new OdinExport, 'odin.csv');
    }

    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/sample_odin.csv";

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return response()->download($file, 'sample_odin.csv', $headers);
    }
}
