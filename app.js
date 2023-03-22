var app = new Vue({
    el: '#app',
    data: {
        todos: [],
        newTodo: ''
    },
    mounted() {
        axios.get('todo.php')
            .then(response => {
                this.todos = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    },
    methods: {
        addTodo() {
            axios.post('todo.php', {
                title: this.newTodo
            })
            .then(response => {
                console.log(response.data);
                this.todos.push(response.data);
                this.newTodo = '';
            })
            .catch(error => {
                console.log(error);
            });
        }
    },
    template: `
        <div>
            <h1>Todo List</h1>
            <ul>
                <li v-for="todo in todos" :key="todo.id">{{ todo.title }}</li>
            </ul>
            <form @submit.prevent="addTodo">
                <input type="text" v-model="newTodo">
                <button type="submit">Add</button>
            </form>
        </div>
    `
});