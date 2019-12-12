<?php

namespace App\Imports;

use App\Tyche;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class TycheImport implements ToModel,WithBatchInserts,WithHeadingRow,WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $value=DB::table('tyches')->where('question', $row['question'])->get();
        if($value->count() == 0) {
            return new Tyche([
                'question'=> $row['question'],
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
