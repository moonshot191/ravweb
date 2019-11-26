<?php

namespace App\Exports;

use App\Zalmo;
use Maatwebsite\Excel\Concerns\FromCollection;

class ZalmoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Zalmo::all();
    }
}
