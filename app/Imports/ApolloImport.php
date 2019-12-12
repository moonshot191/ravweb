<?php

namespace App\Imports;

use App\Apollo;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
class ApolloImport implements ToModel, WithHeadingRow,WithBatchInserts,WithChunkReading
{

    static public function shuffler(string $word){
        $words = explode( " ", $word );
        shuffle($words);
        return implode(" ",$words);
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $value=DB::table('apollos')->where('answer', $row['answer'])->get();
        if($value->count() == 0) {
            return new Apollo(['level' => $row['level'],
                'question' => ApolloImport::shuffler($row['answer']),
                'username' => auth()->user()->username,
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
