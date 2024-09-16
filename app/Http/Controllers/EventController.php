<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Correto para uso do Auth
use Illuminate\Routing\Controller as BaseController;

class EventController extends BaseController
{
    public function index()
    {
        $events = Auth::user()->events; // Pega os eventos do usuário logado
        return view('events.index', compact('events'));
    }

    // Novo evento
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time', // Garante que o horário de fim é após o de início
            'event_date' => 'required|date',
        ]);

        // Verifica se o usuário já tem um evento no mesmo horário
        $existingEvent = Auth::user()->events()
            ->where('event_date', $request->event_date)
            ->where(function($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })
            ->first();

        if ($existingEvent) {
            return back()->withErrors(['error' => 'Horário indisponível.']);
        }

        // Cria o evento
        Auth::user()->events()->create($request->all());

        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso!');
    }

    // Excluir um evento
    public function destroy(Event $event)
    {
        if ($event->user_id != Auth::id()) {
            return abort(403); // Proíbe a exclusão de eventos de outro usuário
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento excluído com sucesso!');
    }
}
