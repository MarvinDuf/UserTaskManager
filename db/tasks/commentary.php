<?php
require_once __DIR__.'/../database.php';

function getCommentaries() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM comments');
    return $stmt->fetchAll();
}

function createCommentary($userId, $taskId, $title, $content, $creationDate) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO comments (userId, taskId, title, content, creationDate) VALUES (?, ?, ?, ?, ?)');
    return $stmt->execute([$userId, $taskId, $title, $content, $creationDate]);
}

function getCommentary($id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM comments WHERE commentaryId = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function updateCommentary($id, $userId, $taskId, $title, $content, $creationDate) {
    global $pdo;
    $stmt = $pdo->prepare('UPDATE comments SET userId = ?, taskId = ?, title = ?, content = ?, creationDate = ? WHERE commentaryId = ?');
    return $stmt->execute([$userId, $taskId, $title, $content, $creationDate, $id]);
}

function deleteCommentary($id) {
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM comments WHERE commentaryId = ?');
    return $stmt->execute([$id]);
}
?>