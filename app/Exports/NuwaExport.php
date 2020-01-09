<?php

namespace App\Exports;

use App\Nuwa;
use Maatwebsite\Excel\Concerns\FromCollection;

class NuwaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Nuwa::all();
    }
}
