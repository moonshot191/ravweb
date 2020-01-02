<?php

namespace App\Http\Controllers;

use App\Kadluq;
use DB;
use Illuminate\Http\Request;
use App\Authorizable;
use App\Kadlu;
class KadluqController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Kadluq $kadluq)
    {
        return view('bot.kadlu.sub.index', ['kadluq' => $kadluq->orderBy('created_at', 'desc')->paginate(50)]);
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
            'kadlu_id' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'answer_d' => 'required',
            'c_answer' => 'required',
        );
        $this->validate($request,$rules);
        $data = request()->except(['_token','_method']);
        $data['created_by']=auth()->user()->username;
        $question = Kadlu::with('kadluq')->findOrFail($request->kadlu_id);
        $sub_question = new Kadluq($data);
//        return $data;
//        $question->kadluq()->save($sub_question);
        $sub_question->kadlu()->associate($question)->save();
        return redirect()->route('kadluqs.index')->withStatus(__('Associate Question created successfully!.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kadluq  $kadluq
     * @return \Illuminate\Http\Response
     */
    public function show(Kadluq $kadluq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kadluq  $kadluq
     * @return \Illuminate\Http\Response
     */
    public function edit(Kadluq $kadluq)
    {
        return view('bot.kadlu.sub.edit',compact('kadluq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kadluq  $kadluq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kadluq $kadluq)
    {
        $rules = array(
            'question'=>'required|string|min:3',
            'kadlu_id' => 'required',
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
        Kadluq::whereId($kadluq->id)->update($data);

//return  $data;
        return redirect()->route('kadluqs.index')->withStatus(__('Question successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kadluq  $kadluq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kadluq $kadluq)
    {
        $kadluq->delete();

        return redirect()->route('kadluqs.index')->withStatus(__('Question successfully deleted.'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("kadluqs")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Question(s) Deleted successfully."]);
    }

    public function validateAll(Request $request){
        $ids = $request->ids;
        DB::table("kadluqs")->whereIn('id',explode(",",$ids))->update(array('validated'=>true,
            'validated_by'=>auth()->user()->username,'validated_at'=>\Carbon\Carbon::now()));
        return response()->json(['success'=>"Question(s) Validated successfully!"]);
    }
}
