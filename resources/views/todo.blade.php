<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .todo-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            backdrop-filter: blur(10px);
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            background: #e0f7fa;
            margin: 10px 0;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s, background 0.3s;
        }

        li:hover {
            background: #b2ebf2;
            transform: translateY(-3px);
        }

        input[type="text"] {
            width: calc(100% - 100px);
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #bbb;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background-color: #26c6da;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
            font-size: 16px;
        }

        button:hover {
            background-color: #00acc1;
            transform: translateY(-2px);
        }

        .task-text {
            flex-grow: 1;
            margin-right: 10px;
            color: #333;
            font-weight: 500;
        }

        .icon {
            cursor: pointer;
            margin-left: 10px;
            color: #555;
            transition: color 0.3s;
        }

        .icon:hover {
            color: #000;
        }

        .edit-form {
            display: none;
            flex-grow: 1;
        }
    </style>
</head>
<body>

<div class="todo-container">
    <h1>To-Do List</h1>
    <form action="/create-task" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Enter a new task" required>
        <button type="submit">Create Task</button>
    </form>
    
    <ul>
        @if(count($tasks ?? []) > 0)
            @foreach($tasks as $task)
                <li>
                    <span class="task-text">{{ $task->title }}</span>
                    <form class="edit-form" action="{{ route('editTask', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="{{ $task->id }}">
                        <input type="text" name="title" value="{{ $task->title }}" required>
                        <button type="submit">Save</button>
                    </form>
                    <span class="icon" onclick="toggleEdit(this)">✏️</span>
                    <span class="icon">
                        <form action="{{ route('deleteTask', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: transparent; border: none; padding: 0; cursor: pointer;">🗑️</button>
                        </form>
                    </span>                </li>
            @endforeach
        @else
            <p>No tasks available.</p>
        @endif
    </ul>
</div>

<script>
    function toggleEdit(icon) {
        const taskText = icon.previousElementSibling.previousElementSibling;
        const editForm = icon.previousElementSibling;

        if (editForm.style.display === 'none') {
            editForm.style.display = 'flex';
            taskText.style.display = 'none';
        } else {
            editForm.style.display = 'none';
            taskText.style.display = 'block';
        }
    }

</script>

</body>
</html>