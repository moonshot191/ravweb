<?php

namespace App\Http\Controllers;

use App\Wala;
use App\Walaq;
use DB;
use Illuminate\Http\Request;
use App\Authorizable;
class WalaqController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Walaq $walaq)
    {
        return view('bot.wala.sub.index', ['walaq' => $walaq->orderBy('created_at', 'desc')->paginate(50)]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'question'=>'required|string|min:3',
            'wala_id' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'answer_d' => 'required',
            'c_answer' => 'required',
        );
        $this->validate($request,$rules);
        $data = request()->except(['_token','_method']);
        $data['created_by']=auth()->user()->username;
        $question = Wala::with('walaq')->findOrFail($request->wala_id);
        $sub_question = new Walaq($data);
//        $question->walaq()->save($sub_question);
        $sub_question->wala()->associate($question)->save();
        return redirect()->route('walaqs.index')->withStatus(__('Associate Question created successfully!.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Walaq  $walaq
     * @return \Illuminate\Http\Response
     */
    public function show(Walaq $walaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Walaq  $walaq
     * @return \Illuminate\Http\Response
     */
    public function edit(Walaq $walaq)
    {
        return view('bot.wala.sub.edit',compact('walaq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Walaq  $walaq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Walaq $walaq)
    {
        $rules = array(
            'question'=>'required|string|min:3',
            'wala_id' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'answer_d' => 'required',
            'c_answer' => 'required',
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
        Walaq::whereId($walaq->id)->update($data);


        return redirect()->route('walaqs.index')->withStatus(__('Question successfully updated.'));
//        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Walaq  $walaq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Walaq $walaq)
    {
        $walaq->delete();

        return redirect()->route('walaqs.index')->withStatus(__('Question successfully deleted.'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("walaqs")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Question(s) Deleted successfully."]);
    }

    public function validateAll(Request $request){
        $ids = $request->ids;
        DB::table("walaqs")->whereIn('id',explode(",",$ids))->update(array('validated'=>true,
            'validated_by'=>auth()->user()->username,'validated_at'=>\Carbon\Carbon::now()));
        return response()->json(['success'=>"Question(s) Validated successfully!"]);
    }
}
