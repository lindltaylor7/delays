<?php

namespace App\Http\Controllers;

use App\Events\UpdateDelay;
use App\Exports\DelaysExport;
use App\Models\Delay;
use App\Models\Reason;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class DelayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('delay/Index', [
            'title' => 'Demoras',
            'description' => 'Aqui se registran las demoras.',
            'vehicles' => Vehicle::all(),
            'reasons' => Reason::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* $validated = $request->validate([
            'user_id' => 'required|max:255',
            'vehicle' => 'required|string|max:255',
            'reason' => 'nullable|string|max:255',
            'status' => 'required',
        ]); */

        $delayData = [
            'user_id' => $request->user_id,
            'vehicle_id' => $request->vehicle_id,
            'reason_id' => $request->reason_id,
            'status' => $request->status,
            'start_time' => now(),
            'end_time' => null,
        ];

        $delay = Delay::create($delayData);

        // Dispara el evento con los datos
        event(new UpdateDelay($delayData));

        return redirect()->route('delay.index')->with('success', 'Demora registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $delay = Delay::findOrFail($id);

        $delay->end_time = now();
        $delay->save();

        return redirect()->route('admin.index')->with('success', 'Demora actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function admin()
    {
        return Inertia::render(
            'admin/Index',
            [
                'delays' => Delay::with(['vehicle', 'reason', 'user'])
                    ->orderBy('created_at', 'desc')
                    ->get(),
            ]
        );
    }

    public function export()
    {
        return Excel::download(new DelaysExport, 'demoras.xlsx');
    }
}
