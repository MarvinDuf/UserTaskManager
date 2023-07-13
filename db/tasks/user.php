<?php
require_once __DIR__.'/../database.php';

function getUsers() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM users');
    return $stmt->fetchAll();
}

function getUser($id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE userId = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getByUserName($username) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    return $stmt->fetch();
}

function createUser($username, $password, $mail, $role, $name, $surname) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO users (username, password, mail, role, name, surname) VALUES (?, ?, ?, ?, ?, ?)');

    //Hash basique du mot de passe à l'enregistrement
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    return $stmt->execute([$username, $hashed_password, $mail, $role, $name, $surname]);
}

function updateUser($id, $username, $password, $mail, $role, $name, $surname) {
    global $pdo;
    $stmt = $pdo->prepare('UPDATE users SET username = ?, password = ?, mail = ?, role = ?, name = ?, surname = ? WHERE userId = ?');

    //Hash basique du mot de passe à la modification
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    return $stmt->execute([$username, $hashed_password, $mail, $role, $name, $surname, $id]);
}

function deleteUser($id) {
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM users WHERE userId = ?');
    return $stmt->execute([$id]);
}
?>