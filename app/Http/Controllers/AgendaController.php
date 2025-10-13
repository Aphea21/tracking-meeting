<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     */
  

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
