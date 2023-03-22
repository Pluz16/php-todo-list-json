<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Todo App</title>
    <style>
        .completed {
            text-decoration: line-through;
        }
    </style>
</head>
<body>
    
    <div id="app" class="container">
        <h1>Todo App</h1>
        <form @submit.prevent="addTodo">
            <input type="text" v-model="newTodo" placeholder="Add a new task">
            <button>Add</button>
        </form>
        <ul>
            <todo-item v-for="todo in filteredTodos" :key="todo.id" :todo="todo" @delete-todo="deleteTodoById" @edit-todo="editTodoById"></todo-item>
        </ul>
    </div>

    <link rel="stylesheet" href="./style/style.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="app.js"></script>
</body>
</html>
