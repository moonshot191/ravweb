<?php

namespace App\Http\Controllers;
use App\Authorizable;
use App\Apollo;
use App\Group;
use App\Imports\ApolloImport;
use App\Exports\ApolloExport;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class ApolloController extends Controller
{
    use Authorizable;

   protected $url ="https://api.telegram.org/bot";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Apollo $model)
    {

        return view('bot.apollo.index', ['apollo' => $model->orderBy('created_at', 'desc')->paginate(100)]); #view('bot.apollo.index', ['apollo' => $model->latest()]);

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

    public function bulkupload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt',

        ]);
        if ($validator->passes()) {

            Excel::import(new ApolloImport,request()->file('csv_file'));
            return redirect()->route('apollo.index')->withStatus(__('File uploaded.'));

        }else{
            return redirect()->route('apolloview')->withStatus(__('File not a CSV.'));

        }

    }


    public function bulkview(Request $request)
    {
       return view('bot.apollo.upload');
    }

    public function export()
    {
        return Excel::download(new ApolloExport, 'apollo.csv');
    }

    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/sample_apollo.csv";

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return response()->download($file, 'sample_apollo.csv', $headers);
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
        $rules = array(
            'answer'=>'required|string|min:3',
            'question'=> 'required|string|min:3',
            'level' => 'required|numeric',
            'group_id'=>'required'
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
        Apollo::whereId($apollo->id)->update($data);


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

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("apollos")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Question(s) Deleted successfully."]);
    }

    public function validateAll(Request $request){
        $ids = $request->ids;
        DB::table("apollos")->whereIn('id',explode(",",$ids))->update(array('validated'=>true,
            'validated_by'=>auth()->user()->username,'validated_at'=>\Carbon\Carbon::now()));
        return response()->json(['success'=>"Question(s) Validated successfully!"]);
    }


}
