<?php

namespace App\Exports;

use App\Africa;
use Maatwebsite\Excel\Concerns\FromCollection;

class AfricaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Africa::all();
    }
}
