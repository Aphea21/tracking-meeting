<?php

namespace App\Http\Controllers;

use App\Models\Concern;
use App\Models\Agenda;
use Illuminate\Http\Request;

class ConcernController extends Controller
{
    public function store(Request $request, Agenda $agenda)
    {
        $request->validate([
            'description' => 'required|string',
            'responsible_person' => 'nullable|string',
            'status' => 'nullable|string',
            'due_date' => 'nullable|date',
            'comments' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,docx,jpg,png|max:2048',
        ]);

        $concern = new Concern($request->except('file_path'));

        if ($request->hasFile('file_path')) {
            $concern->file_path = $request->file('file_path')->store('concerns');
        }

        $concern->agenda_id = $agenda->id;
        $concern->save();

        return redirect()->back()->with('success', 'Concern added successfully.');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
