<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Console\View\Components\Task as ComponentsTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Model
{
    // Exibe a lista de tarefas do usuário autenticado
    public function index()
    {
        $tasks = TaskController::where('user_id', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }

    //formulário de criação de nova tarefa
    public function create()
    {
        return view('tasks.create');
    }

    // Armazena uma nova tarefa no banco de dados
    public function store(Request $request)
    {
        // Valida os dados do formulário
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required|date_format:H:i',
        ]);

        // Se a validação falhar, redireciona de volta com erros
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Verifica se já existe uma tarefa agendada para o mesmo dia e horário
        $existingTask = TaskController::where('user_id', Auth::id())
                             ->whereDate('scheduled_date', $request->scheduled_date)
                             ->whereTime('scheduled_time', $request->scheduled_time)
                             ->exists();

        if ($existingTask) {
            return redirect()->back()->withErrors(['message' => 'Já existe uma tarefa agendada para este horário.']);
        }

        // Cria a tarefa
        TaskController::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'scheduled_date' => $request->scheduled_date,
            'scheduled_time' => $request->scheduled_time,
        ]);

        // Redireciona para a lista de tarefas com uma mensagem de sucesso
        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }
}
