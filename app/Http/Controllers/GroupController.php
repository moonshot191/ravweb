<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use App\Authorizable;
use App\Http\Requests\GroupRequest;
class GroupController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Group $model)
    {
        return view('groups.index', ['groups' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request,Group $model)
    {
        $model->create($request->all());
//        $data = $request->all();
//        $data['group_admin']=auth()->user()->user_id;
//        $group= Group::create($data);
        return redirect()->route('groups.index')->withStatus(__('Group successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('groups.edit',compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->all());
//        $data = $request->all();
//        $data['group_admin']=auth()->user()->user_id;
////        return $data;
//        $group= Group::update($data);
        return redirect()->route('groups.index')->withStatus(__('Group successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index')->withStatus(__('Group successfully deleted.'));
    }
}
