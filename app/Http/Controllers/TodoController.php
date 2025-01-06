<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
        try {
            $todo = Todo::create($request->all());
            return response()->json(['message' => 'Todo created'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Todo creation failed'], 500);
        }
    }
        // Fetch all todos
    public function index()
    {
        $todos = Todo::all();
        return response()->json($todos);
    }

    public function show(Todo $todo)
    {
        return response()->json($todo);
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
        ]);

        try {
            $todo->update($request->all());
            return response()->json(['message: ' => 'Todo updated'],200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Todo update failed'], 500);
        }
    }
    public function destroy(Todo $todo)
    {
        try {
            $todo->delete();
            return response()->json(['message' => 'Todo deleted']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Todo deletion failed'], 500);
        }
    }
}