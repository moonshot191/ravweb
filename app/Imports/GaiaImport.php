<?php

namespace App\Imports;

use App\Gaia;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class GaiaImport implements ToModel,WithHeadingRow , WithBatchInserts,WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $value=DB::table('gaias')->where('answer', $row['answer'])->get();
        if($value->count() == 0){

            return new Gaia(
                ['answer'=> $row['answer'],
                    'level'=> $row['level'],
                    'language'=>$row['language'],
                    'username'=>auth()->user()->username,
                    'user_id'=>auth()->user()->user_id,
                ]);
        }

    }

    public function batchSize(): int
    {
        return 200;
    }
    public function chunkSize(): int
    {
        return 200;
    }
}
