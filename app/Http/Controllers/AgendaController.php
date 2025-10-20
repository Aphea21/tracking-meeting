<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class AgendaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        if ($user->role === 'admin') {
            $agendas = Agenda::all(); // admin sees everything
        } elseif ($user->role === 'member') {
            $agendas = Agenda::where('created_by', $user->id)->get(); // only their own
        } else {
            $agendas = Agenda::where('status', 'published')->get(); // normal users see limited
        }
    
        return view('agendas.index', compact('agendas'));
    }
    

    public function show(Agenda $agenda)
    {
        return view('agendas.show', compact('agenda'));
    }


    /**
     * Show the form for creating a new resource.
     */public function create()
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized');
    }
    return view('agendas.create');
}

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'title' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'file_path' => 'nullable|file|max:2048',
        ]);

        // Handle file upload (optional)
        $filePath = null;
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filePath = $file->store('uploads/agendas', 'public');
        }

        // Create new agenda
        Agenda::create([
            'title' => $request->title,
            // 👇 Automatically insert today's date (even if user didn’t input)
            'date' => now()->toDateString(),
            'created_by' => Auth::id(), // or manually set an ID if not using auth
            'notes' => $request->notes,
            'file_path' => $filePath,
            'status' => 'Pending', // Default value, you can change it
        ]);

        return redirect()->back()->with('success', 'Agenda saved successfully!');
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
