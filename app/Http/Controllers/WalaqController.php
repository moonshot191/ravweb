<?php

namespace App\Http\Controllers;

use App\Walaq;
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
        return $request->all();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Walaq  $walaq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Walaq $walaq)
    {
        //
    }
}
