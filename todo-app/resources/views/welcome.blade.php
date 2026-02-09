<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Todo-app</title>
</head>
<body class="bg-gray-100 p-12">
    
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Мои задачи</h1>

        <form action="/tasks" method="POST" class="mb-6">
            @csrf
            <input type="text" name="title" placeholder="Название" class="border p-2 w-full mb-2 required">
            <textarea name="description" placeholder="Описание" class="border p-2 w-full mb-2 min-h-[42px]"></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Добавить</button>
        </form>

        <ul>
           @foreach($tasks as $task)
            <li class="border-b py-2 flex justify-between items-center {{ $task->completed_at ? 'opacity-50' : '' }}">
                <div class="flex items-center gap-4">
                    <form action="/tasks/{{ $task->id }}/toggle" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" 
                            onChange="this.form.submit()" 
                            {{ $task->completed_at ? 'checked' : '' }}
                            class="w-5 h-5 cursor-pointer">
                    </form>

                   <div class="flex flex-col min-w-0 flex-1">
                        <div class="{{ $task->completed_at ? 'line-through text-gray-500' : '' }}">
                            <div class="font-bold text-lg break-all">{{ $task->title }}</div>
                            <div class="text-sm break-all leading-relaxed">{{ $task->description }}</div>
                        </div>

                        <div class="mt-1">
                            @if($task->completed_at)
                                <div class="text-xs text-green-600 font-semibold no-underline">
                                    Завершено: {{ $task->completed_at->format('d.m.Y H:i') }}
                                </div>
                            @else
                                <div class="text-xs text-gray-400">
                                    Создано: {{ $task->created_at->format('d.m.Y H:i') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    @if(!$task->completed_at)
                        <a href="/tasks/{{ $task->id }}/edit" class="text-blue-500 text-sm italic pt-0.5">Редактировать</a>
                    @endif

                    <form action="/tasks/{{ $task->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 text-sm">Удалить</button>
                    </form>
                </div>
            </li>
        @endforeach
        </ul>
    </div>

</body>
</html>