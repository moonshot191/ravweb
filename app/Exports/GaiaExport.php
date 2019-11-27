<?php

namespace App\Exports;

use App\Gaia;
use Maatwebsite\Excel\Concerns\FromCollection;

class GaiaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Gaia::all();
    }
}
