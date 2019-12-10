<?php

namespace App\Exports;

use App\Leizi;
use Maatwebsite\Excel\Concerns\FromCollection;

class LeiziExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Leizi::all();
    }
}
