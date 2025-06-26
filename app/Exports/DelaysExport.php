<?php

namespace App\Exports;

use App\Models\Delay;
use Maatwebsite\Excel\Concerns\FromCollection;

class DelaysExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Delay::all();
    }
}
