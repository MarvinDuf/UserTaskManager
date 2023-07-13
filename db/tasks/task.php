<?php
require_once __DIR__.'/../database.php';

function getTasks() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM tasks');
    return $stmt->fetchAll();
}

function createTask($userTaskCreatorId, $userInChargeId, $projectId, $name, $category, $creationDate, $priority, $status, $complexity) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO tasks (userTaskCreatorId, userInChargeId, projectId, name, category, creationDate, priority, status, complexity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    return $stmt->execute([$userTaskCreatorId, $userInChargeId, $projectId, $name, $category, $creationDate, $priority, $status, $complexity]);
}

function getTask($id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM tasks WHERE taskId = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function updateTask($id, $userTaskCreatorId, $userInChargeId, $projectId, $name, $category, $creationDate, $priority, $status, $complexity) {
    global $pdo;
    $stmt = $pdo->prepare('UPDATE tasks SET userTaskCreatorId = ?, userInChargeId = ?, projectId = ?, name = ?, category = ?, creationDate = ?, priority = ?, status = ?, complexity = ? WHERE taskId = ?');
    return $stmt->execute([$userTaskCreatorId, $userInChargeId, $projectId, $name, $category, $creationDate, $priority, $status, $complexity, $id]);
}

function deleteTask($id) {
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM tasks WHERE taskId = ?');
    return $stmt->execute([$id]);
}
?>