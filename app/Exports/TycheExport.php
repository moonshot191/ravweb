<?php

namespace App\Exports;

use App\Tyche;
use Maatwebsite\Excel\Concerns\FromCollection;

class TycheExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Tyche::all();
    }
}
