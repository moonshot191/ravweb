<?php

namespace App\Imports;

use App\Zalmo;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ZalmoImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {

        $value=DB::table('zalmos')->where('answer', $row['answer'])->get();
        if($value->count() == 0){

            return new Zalmo(
                ['answer'=> $row['answer'],
                    'level'=> $row['level'],
                    'language'=>$row['language'],
                    'username'=>auth()->user()->username,
                    'user_id'=>auth()->user()->user_id,
                ]);
        }

    }
}
