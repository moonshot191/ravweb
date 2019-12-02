<?php

namespace App\Exports;

use App\Seshat;

use Maatwebsite\Excel\Concerns\FromCollection;
class SeshatExport implements  FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
     *
    */
    public function collection()
    {
        return Seshat::all('username','question','answer','level','edited_by','validated','validated_by');
    }

}
