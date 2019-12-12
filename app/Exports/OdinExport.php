<?php

namespace App\Exports;

use App\Odin;
use Maatwebsite\Excel\Concerns\FromCollection;

class OdinExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Odin::all();
    }
}
