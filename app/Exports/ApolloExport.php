<?php

namespace App\Exports;

use App\Apollo;
use Maatwebsite\Excel\Concerns\FromCollection;

class ApolloExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Apollo::all();
    }
}
