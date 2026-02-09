<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Редактировать задачу</title>
</head>
<body class="bg-gray-100 p-12">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-">
        <h1 class="text-2xl font-bold mb-4">Редактировать задачу</h1>
        <form action="/tasks/{{ $task->id }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
                <label class="block mb-2 text-sm font-medium">Заголовок</label>
            <input type="text" name="title" value="{{ $task->title }}" class="border p-2 w-full mb-4" required>

            <label class="block mb-2 text-sm font-medium">Описание</label>
            <textarea name="description" class="border p-2 w-full mb-4">{{ $task->description }}</textarea>

            <div class="flex gap-2">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Сохранить изменения</button>
                <a href="/" class="bg-gray-500 text-white px-4 py-2 rounded text-center">Отмена</a>
            </div>
        </form>
    </div>
</body>
</html>