<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 480px; margin: 40px auto; color: #1f2937; }
        h1 { font-size: 1.5rem; }
        form.add-task { display: flex; gap: 8px; margin-bottom: 24px; }
        form.add-task input[type="text"] { flex: 1; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; }
        form.add-task button { padding: 8px 16px; background: #2563eb; color: #fff; border: none; border-radius: 6px; cursor: pointer; }
        ul { list-style: none; padding: 0; }
        li { display: flex; align-items: center; gap: 8px; padding: 8px 0; border-bottom: 1px solid #e5e7eb; }
        li form { display: inline; }
        li .title { flex: 1; }
        li .done { text-decoration: line-through; color: #9ca3af; }
        li button { background: none; border: none; cursor: pointer; color: #ef4444; }
        .empty { color: #9ca3af; }
        .errors { color: #ef4444; margin-bottom: 12px; }
    </style>
</head>
<body>
    <h1>To-Do List</h1>

    @if ($errors->any())
        <div class="errors">{{ $errors->first() }}</div>
    @endif

    <form class="add-task" method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <input type="text" name="title" placeholder="Tambah tugas baru..." required maxlength="255">
        <button type="submit">Tambah</button>
    </form>

    @if ($tasks->isEmpty())
        <p class="empty">Belum ada tugas.</p>
    @else
        <ul>
            @foreach ($tasks as $task)
                <li>
                    <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" onchange="this.form.submit()" {{ $task->is_done ? 'checked' : '' }}>
                    </form>
                    <span class="title {{ $task->is_done ? 'done' : '' }}">{{ $task->title }}</span>
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" aria-label="Hapus">&times;</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
