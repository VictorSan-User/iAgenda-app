<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Exibe a lista de eventos do usuário logado
    public function index()
    {
        $user = Auth::user(); // Obtém o usuário autenticado
        $events = $user->events; // Pega os eventos do usuário
        return view('events.index', compact('events'));
    }

    // Armazena um novo evento
    public function store(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'title' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time', // Garante que o horário de fim é após o de início
            'event_date' => 'required|date',
        ]);

        // Verifica se o usuário já tem um evento no mesmo horário
        $user = Auth::user();
        $existingEvent = $user->events()
            ->where('event_date', $request->event_date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })
            ->first();

        if ($existingEvent) {
            return back()->withErrors(['time' => 'Horário indisponível.']);
        }

        // Cria o evento
        $user->events()->create($request->only(['title', 'start_time', 'end_time', 'event_date']));

        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso!');
    }

    // Exclui um evento
    public function destroy(Event $event)
    {
        // Verifica se o evento pertence ao usuário autenticado
        if ($event->user_id !== Auth::id()) {
            return abort(403); // Proíbe a exclusão de eventos de outro usuário
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento excluído com sucesso!');
    }
}
