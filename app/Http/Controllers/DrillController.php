<?php

namespace App\Http\Controllers;

use App\Models\Drill;
use App\Http\Requests\StoreDrillRequest;
use App\Http\Requests\UpdateDrillRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DrillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('drill/Index', [
            'title' => 'Reportes de Perforadoras',
            'description' => 'Aqui se registran los reportes de Perforadoras.',
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
        $drill = Drill::create($request->all());

        return to_route('drill.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Drill $drill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Drill $drill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDrillRequest $request, Drill $drill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drill $drill)
    {
        //
    }
}
