<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Вывод списка задач
    public function index(){
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('welcome', compact('tasks'));
    }

    // Сохранение новой задачи
    public function store(Request $request){
        $request->validate(['title' => 'required']);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect('/');
    }

    // Удаление задачи
    public function destroy(Task $task){
        $task->delete();
        return redirect('/');
    }

    // Страница редактирования
    public function edit(Task $task){
        return view('edit', compact('task'));
    }

    // Обновление задачи в БД
    public function update(Request $request, Task $task){
        $request->validate(['title' => 'required']);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect('/');
    }

    // Переключение статуса задачи
    public function toggle(Task $task){
        if($task->completed_at) {$task->update(['completed_at' => null]);}
        else {$task->update(['completed_at' => now()]);}

        return redirect('/');
    }
}
