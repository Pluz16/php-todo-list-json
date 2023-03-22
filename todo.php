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
        'title' => $input['title']
    );
    array_push($todos, $newTodo);
    file_put_contents($filename, json_encode($todos));
    echo json_encode($newTodo);
}

?>