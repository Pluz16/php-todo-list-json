Vue.component('todo-item', {
    props: ['todo'],
    template: `
      <li>
        <div class="checkbox">
          <input type="checkbox" v-model="todo.completed" @change="updateTodo">
        </div>
        <div class="title" :class="{ completed: todo.completed }" @click="editTodo">{{ todo.title }}</div>
        <button class="delete" @click="deleteTodo">X</button>
      </li>
    `,
    methods: {
      updateTodo() {
        axios.put('todo.php?id=' + this.todo.id, { completed: this.todo.completed })
          .then(response => console.log(response.data))
          .catch(error => console.log(error));
      },
      deleteTodo() {
        axios.delete('todo.php?id=' + this.todo.id)
          .then(response => console.log(response.data))
          .catch(error => console.log(error));
        this.$emit('delete-todo', this.todo.id);
      },
      editTodo() {
        this.$emit('edit-todo', this.todo.id);
      }
    }
  });
  
  new Vue({
    el: '#app',
    data: {
      todos: [],
      newTodo: '',
      editingTodoId: null
    },
    created() {
      axios.get('todo.php')
        .then(response => this.todos = response.data)
        .catch(error => console.log(error));
    },
    computed: {
      filteredTodos() { return this.todos.filter(todo => !todo.completed);
      }
      },
      methods: {
      addTodo() {
      const todo = { title: this.newTodo, completed: false };
      axios.post('todo.php', todo)
      .then(response => {
      this.todos.push(response.data);
      this.newTodo = '';
      })
      .catch(error => console.log(error));
      },
      deleteTodoById(id) {
      this.todos = this.todos.filter(todo => todo.id != id);
      },
      editTodoById(id) {
      this.editingTodoId = id;
      }
      }
      });
  