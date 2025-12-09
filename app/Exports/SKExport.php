<?php

namespace App\Exports;

use App\Models\SK;
use Maatwebsite\Excel\Concerns\FromCollection;

class SKExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SK::all();
    }
}
