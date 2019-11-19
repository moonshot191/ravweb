<?php

namespace App\Http\Controllers;

use App\Seshat;
use Illuminate\Http\Request;
use App\Authorizable;
class SeshatController extends Controller
{
//    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seshat $model)
    {
        return view('bot.seshat.index', ['seshat' => $model->orderBy('created_at', 'desc')->paginate(10)]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bot.seshat.create');
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
            'answer'=>'required|min:4',
            'level'=>'integer|required',
            'img_path'=>'required | max:2000'

        ]);
        $mime = array('jpeg', 'png', 'bmp', 'gif', 'svg','webp','jpg','tif');
        $file = $request->file('img_path');
        $ext =$file->getClientOriginalExtension();
        $filename = $file->getClientOriginalName().time();
        $destinationPath = 'seshat';
        $data = request()->except(['_token','_method']);
        $data['username']=auth()->user()->username;
        $data['img_path']=$filename;

        if (!in_array($ext, $mime)){
            return redirect()->route('seshats.create')->withStatus(__('Only images images and gifs allowed!.'));
        }
        $file->move(public_path($destinationPath),$filename);
        Seshat::create($data);
        return redirect()->route('seshats.index')->withStatus(__('Question created successfully!.'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seshat  $seshat
     * @return \Illuminate\Http\Response
     */
    public function show(Seshat $seshat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seshat  $seshat
     * @return \Illuminate\Http\Response
     */
    public function edit(Seshat $seshat)
    {
        return view('bot.seshat.edit',compact('seshat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seshat  $seshat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seshat $seshat)
    {
        $rules = array(
            'answer'=>'required|string|min:3',
            'question'=> 'required|string|min:3',
            'level' => 'required|numeric',
        );

        $this->validate($request,$rules);
        $data = request()->except(['_token','_method']);

        if(isset($data['img_path'])){
            $mime = array('jpeg', 'png', 'bmp', 'gif', 'svg','webp','jpg','tif');
            $file =$data['img_path'];
            $ext =$file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName().time();
            $destinationPath = 'seshat';
            $data['edited_by']=auth()->user()->username;
            $data['username']=auth()->user()->username;
            if (!in_array($ext, $mime)){
//
                return redirect('/seshats/'.$seshat->id.'/edit')->withStatus(__('Only images images and gifs allowed!.'));
//
//                return ext;
            }else{
                $data['img_path']=$filename;
                $file->move(public_path($destinationPath),$filename);
            }


        }

        if(isset($data['validated'])){

            $data['validated']=true;
            $data['validated_by']=auth()->user()->username;
            $data['validated_at']=\Carbon\Carbon::now();
        }else{
            $data['validated']=false;
        }

        Seshat::whereId($seshat->id)->update($data);


        return redirect()->route('seshats.index')->withStatus(__('Question successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seshat  $seshat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seshat $seshat)
    {
       $seshat->delete();
        return redirect()->route('seshats.index')->withStatus(__('Question successfully deleted.'));
    }
}
