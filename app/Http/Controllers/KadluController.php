<?php

namespace App\Http\Controllers;

use App\Kadlu;
use DB;
use Illuminate\Http\Request;
use App\Authorizable;
class KadluController extends Controller
{
    use Authorizable;

    static function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Kadlu $kadlu)
    {
        return view('bot.kadlu.index',['kadlu'=>$kadlu->orderBy('created_at', 'desc')->paginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bot.kadlu.create');
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
            'c_type'=>'required',
            'filename' => 'required',
            'title'=> 'required',
            'level'=>'required',

        );
        $this->validate($request,$rules);
        $data = request()->except(['_token','_method']);


        if(KadluController::startsWith($request->file('filename')->getClientMimeType(),'audio') or KadluController::startsWith($request->file('filename')->getClientMimeType(),'video')){
            $filename = base64_encode(file_get_contents($request->file('filename')));
            $data['filename']=$filename;
            $data['created_by']=auth()->user()->username;
             Kadlu::create($data);
//return $data;
            return redirect()->route('kadlus.index')->withStatus(__('Question created successfully!.'));
        }else{
            return redirect()->route('kadlus.create')->withStatus(__('Only Audio or video allowed!.'));
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kadlu  $kadlu
     * @return \Illuminate\Http\Response
     */
    public function show(Kadlu $kadlu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kadlu  $kadlu
     * @return \Illuminate\Http\Response
     */
    public function edit(Kadlu $kadlus)
    {
        return view('bot.kadlu.edit',compact('kadlus'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kadlu  $kadlu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kadlu $kadlus)
    {
        $rules = array(
            'c_type'=>'required',
            'title'=> 'required',
            'level'=>'required',

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

        if($request->hasfile('filename'))
        {
            if(KadluController::startsWith($request->file('filename')->getClientMimeType(),'audio') or KadluController::startsWith($request->file('filename')->getClientMimeType(),'video')) {
                $filename = base64_encode(file_get_contents($request->file('filename')));
                $data['filename'] = $filename;
            }else{
                return redirect()->back()->withStatus(__('Only Audio or video allowed!.'));
            }

        }
        $data['edited_by']=auth()->user()->username;
        $sss =Kadlu::whereId($kadlus->id)->update($data);
//return $data;

        return redirect()->route('kadlus.index')->withStatus(__('Question successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kadlu  $kadlu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kadlu $kadlus)
    {
        $kadlus->delete();

        return redirect()->route('kadlus.index')->withStatus(__('Question successfully deleted.'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("kadlus")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Question(s) Deleted successfully."]);
    }

    public function validateAll(Request $request){
        $ids = $request->ids;
        DB::table("kadlus")->whereIn('id',explode(",",$ids))->update(array('validated'=>true,
            'validated_by'=>auth()->user()->username,'validated_at'=>\Carbon\Carbon::now()));
        return response()->json(['success'=>"Question(s) Validated successfully!"]);
    }
}
