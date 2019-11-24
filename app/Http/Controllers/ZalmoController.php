<?php

namespace App\Http\Controllers;

use App\Group;
use App\Zalmo;
use Illuminate\Http\Request;

class ZalmoController extends Controller
{
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
        $input = $request->all();

        return $input['file'];
    }

    public function ajaxRequest()

    {

        return view('bot.zalmo.create');

    }


    public function ajaxRequestPost(Request $request)

    {

        $input = $request->all();

        return response()->json($input);

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
