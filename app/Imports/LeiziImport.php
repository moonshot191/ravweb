<?php

namespace App\Imports;

use App\Leizi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class LeiziImport implements ToModel,WithBatchInserts,WithHeadingRow,WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $value=DB::table('leizis')->where('answer', $row['answer'])->get();
        if($value->count() == 0) {
            return new Leizi(['instruction'=> $row['instruction'],
                'answer'=> $row['answer'],
                'question'=> $row['question'],
                'alternative'=> $row['alternative'],
                'level'=> $row['level'],
                'language'=>$row['language'],
                'username'=>auth()->user()->username,
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
