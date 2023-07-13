<?php
require_once __DIR__.'/../database.php';

function getProjects() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM projects');
    return $stmt->fetchAll();
}

function createProject($name, $status) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO projects (name, status) VALUES (?, ?)');
    return $stmt->execute([$name, $status]);
}

function getProject($id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM projects WHERE projectId = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function updateProject($id, $name, $status) {
    global $pdo;
    $stmt = $pdo->prepare('UPDATE projects SET name = ?, status = ? WHERE projectId = ?');
    return $stmt->execute([$name, $status, $id]);
}

function deleteProject($id) {
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM projects WHERE projectId = ?');
    return $stmt->execute([$id]);
}
?>