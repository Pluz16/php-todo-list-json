<?php

$filename = 'todo.json';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $todos = json_decode(file_get_contents($filename), true);
    echo json_encode($todos);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $todos = json_decode(file_get_contents($filename), true);
    $newTodo = array(
        'id' => count($todos) + 1,
        'title' => $input['title'],
        'completed' => $input['completed']
    );
    array_push($todos, $newTodo);
    file_put_contents($filename, json_encode($todos));
    echo json_encode($newTodo);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = json_decode(file_get_contents('php://input'), true);
    $todos = json_decode(file_get_contents($filename), true);
    $id = $_GET['id'];
    foreach ($todos as &$todo) {
        if ($todo['id'] == $id) {
            $todo['completed'] = $input['completed'];
            break;
        }
    }
    file_put_contents($filename, json_encode($todos));
    echo json_encode($input);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    $todos = json_decode(file_get_contents($filename), true);
    $filtered = array_filter($todos, function($todo) use ($id) {
        return $todo['id'] != $id;
    });
    file_put_contents($filename, json_encode(array_values($filtered)));
    echo json_encode($id);
}

?>
