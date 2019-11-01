<?php

namespace App\Http\Controllers;

use App\Apollo;
use App\Group;
use App\Http\Requests\GroupRequest;
use Illuminate\Http\Request;

class ApolloController extends Controller
{

   protected $url ="https://api.telegram.org/bot";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Apollo $model)
    {

        return view('bot.apollo.index', ['apollo' => $model->paginate(10)]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::pluck('group_title','group_id');
        return view('bot.apollo.create',compact('groups'));
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
            'question'=>'required|min:8',
            'answer'=>'required|min:8',
            'group_id'=>'required|integer',
            'level'=>'required'

        ]);
        $data =$request->all();
        $data['username']=auth()->user()->username;
        $data['user_id'] = auth()->user()->id;
        $apollo= Apollo::create($data);
//return $data;
        return redirect()->route('apollo.index')->withStatus(__('Question created successfully!.'));
    }



    public function send(Request $request)
    {
        $id = $request->get('qid');
        $question = Apollo::find($id);
        $token =Group::where('group_id','=',$question->group_id)->firstOrFail();
        $send = $this->getJson($this->url.$token->token.'/sendMessage?chat_id='.$question->group_id.'&text='.$question->question);
        $message_id = json_encode($send->result->message_id);
        $question->message_id=$message_id;
        $question->save();
        return redirect()->route('apollo.index')->withStatus(__('Question posted successfully! Do not repost it until it\'s answered.'));
    }


    protected function getJson($url)
    {
        $response = file_get_contents($url, false);
        return json_decode( $response );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apollo  $apollo
     * @return \Illuminate\Http\Response
     */
    public function show(Apollo $apollo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apollo  $apollo
     * @return \Illuminate\Http\Response
     */
    public function edit(Apollo $apollo)
    {
        $groups = Group::pluck('group_title','group_id');
        return view('bot.apollo.edit',compact('apollo','groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apollo  $apollo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apollo $apollo)
    {
       $apollo->update($request->all());
        return redirect()->route('apollo.index')->withStatus(__('Question successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apollo  $apollo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apollo $apollo)
    {
        $apollo->delete();

        return redirect()->route('apollo.index')->withStatus(__('Question successfully deleted.'));
    }



}
