<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Group;
use App\Zalmo;
use Illuminate\Http\Request;
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
        $groups = Group::pluck('group_title','group_id');
        return view('bot.zalmo.create',compact('groups'));
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
            'file' => 'required',
            'answer' => 'required',
            'language' => 'required',
            'level' => 'required',
        ]);
        if ($validator->passes()) {

            return response()->json(['success'=>'Question saved successfully!','redirecturl'=>'/zalmos']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zalmo  $zalmo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zalmo $zalmo)
    {
        //
    }
}
