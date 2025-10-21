<?php

namespace App\Http\Controllers;

use App\Models\Concern;
use App\Models\Agenda;
use Illuminate\Http\Request;

class ConcernController extends Controller
{
    public function index($agenda_id)
    {
        $agenda = Agenda::findOrFail($agenda_id);
        $concerns = Concern::where('agenda_id', $agenda_id)->get();
        return view('concerns.index', compact('agenda', 'concerns'));
    }

    public function create($agenda_id)
    {
        $agenda = Agenda::findOrFail($agenda_id);
        return view('concerns.create', compact('agenda'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'agenda_id' => 'required',
            'description' => 'required|string',
            'responsible_person' => 'required|string',
            'status' => 'required|string',
            'due_date' => 'nullable|date',
            'comments' => 'nullable|string',
            'file' => 'nullable|file|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('concerns', 'public');
        }

        Concern::create([
            'agenda_id' => $request->agenda_id,
            'description' => $request->description,
            'responsible_person' => $request->responsible_person,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'comments' => $request->comments,
            'file_path' => $filePath,
        ]);

        return redirect()->route('concerns.index', $request->agenda_id)->with('success', 'Concern added successfully.');
    }

    public function edit($id)
    {
        $concern = Concern::findOrFail($id);
        return view('concerns.edit', compact('concern'));
    }

    public function update(Request $request, $id)
    {
        $concern = Concern::findOrFail($id);

        $request->validate([
            'description' => 'required|string',
            'responsible_person' => 'required|string',
            'status' => 'required|string',
            'due_date' => 'nullable|date',
            'comments' => 'nullable|string',
        ]);

        $concern->update($request->only([
            'description',
            'responsible_person',
            'status',
            'due_date',
            'comments'
        ]));

        return redirect()->route('concerns.index', $concern->agenda_id)->with('success', 'Concern updated successfully.');
    }

    public function destroy($id)
    {
        $concern = Concern::findOrFail($id);
        $concern->delete();

        return back()->with('success', 'Concern deleted successfully.');
    }
}
