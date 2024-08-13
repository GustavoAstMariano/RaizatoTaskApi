<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Recuperar uma lista de todas as tarefas
    public function index()
    {
        return Task::all();
    }

    // Criar uma nova tarefa
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean'
        ]);

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    // Recuperar os detalhes de uma tarefa específica
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    // Atualizar uma tarefa existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean'
        ]);

        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->update($request->all());
        $task->touch();  // Atualiza a data de atualização

        return response()->json($task, 200);
    }

    // Apagar uma tarefa existente
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(null, 204);
    }

    // Alterar o status de uma tarefa existente
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'completed' => 'required|boolean'
        ]);

        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->completed = $request->completed;
        $task->touch();  // Atualiza a data de atualização
        $task->save();

        return response()->json($task, 200);
    }
}
