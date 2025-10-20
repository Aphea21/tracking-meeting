<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concern;
use App\Models\Agenda;

class ConcernController extends Controller
{
    // Store new concern
    public function store(Request $request, $agenda_id)
    {
        $request->validate([
            'description' => 'required|string',
            'responsible_person' => 'nullable|string|max:255',
            'status' => 'required|string',
            'due_date' => 'nullable|date',
            'comments' => 'nullable|string',
            'file_path' => 'nullable|file|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('uploads/concerns', 'public');
        }

        Concern::create([
            'agenda_id' => $agenda_id,
            'description' => $request->description,
            'responsible_person' => $request->responsible_person,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'comments' => $request->comments,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Concern added successfully.');
    }

    // Update concern
    public function update(Request $request, Concern $concern)
    {
        $request->validate([
            'description' => 'required|string',
            'status' => 'required|string',
        ]);

        $concern->update($request->all());

        return redirect()->back()->with('success', 'Concern updated successfully.');
    }

    // Delete concern
    public function destroy(Concern $concern)
    {
        $concern->delete();
        return redirect()->back()->with('success', 'Concern deleted.');
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
 
}
