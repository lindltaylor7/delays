<?php

namespace App\Exports;

use App\Models\Delay;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DelaysExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Delay::with('vehicle', 'reason', 'user')
            ->select('id', 'user_id', 'vehicle_id', 'reason_id', 'status', 'start_time', 'end_time')
            ->get()
            ->map(function ($delay) {
                return [
                    'ID' => $delay->id,
                    'Usuario' => $delay->user->name ?? 'N/A',
                    'Vehículo' => $delay->vehicle->code ?? 'N/A',
                    'Razón' => $delay->reason->description ?? 'N/A',
                    'Estado' => $delay->status,
                    'Hora de Inicio' => $delay->start_time,
                    'Hora de Fin' => $delay->end_time,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Usuario',
            'Vehículo',
            'Razón',
            'Estado',
            'Hora de Inicio',
            'Hora de Fin',
        ];
    }
}
