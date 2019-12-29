<?php

namespace App\Http\Controllers;

use App\Wala;
use DB;
use Illuminate\Http\Request;
use App\Authorizable;
class WalaController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Wala $wala)
    {
        return view('bot.wala.index',['wala'=>$wala->orderBy('created_at', 'desc')->paginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bot.wala.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'question'=>'required|min:4',
            'title'=>'required|min:4',
            'level'=>'required'

        ]);
        $data =$request->except(['_method','_token']);
        $data['created_by']=auth()->user()->username;

        $apollo= Wala::create($data);
//return $data;
        return redirect()->route('walas.index')->withStatus(__('Question created successfully!.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wala  $wala
     * @return \Illuminate\Http\Response
     */
    public function show(Wala $wala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wala  $wala
     * @return \Illuminate\Http\Response
     */
    public function edit(Wala $wala)
    {
        return view('bot.wala.edit',compact('wala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wala  $wala
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wala $wala)
    {
        $this->validate($request,[
            'question'=>'required|min:4',
            'title'=>'required|min:4',
            'level'=>'required'

        ]);
        $data =$request->except(['_method','_token']);
        if(isset($data['validated'])){

            $data['validated']=true;
            $data['validated_by']=auth()->user()->username;
            $data['validated_at']=\Carbon\Carbon::now();
        }else{
            $data['validated']=false;
        }
        $data['edited_by']=auth()->user()->username;
        Wala::whereId($wala->id)->update($data);


        return redirect()->route('walas.index')->withStatus(__('Question successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wala  $wala
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wala $wala)
    {
        $wala->delete();

        return redirect()->route('walas.index')->withStatus(__('Question successfully deleted.'));
    }


    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("walas")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Question(s) Deleted successfully."]);
    }

    public function validateAll(Request $request){
        $ids = $request->ids;
        DB::table("walas")->whereIn('id',explode(",",$ids))->update(array('validated'=>true,
            'validated_by'=>auth()->user()->username,'validated_at'=>\Carbon\Carbon::now()));
        return response()->json(['success'=>"Question(s) Validated successfully!"]);
    }
}
