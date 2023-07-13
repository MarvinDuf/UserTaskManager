<!DOCTYPE html>
<html>
<head>
    <title>Gestion des utilisateurs</title>
</head>
<body>

<?php
require_once __DIR__.'/authentification/sessionCheck.php';
require_once __DIR__.'/layout/header.php';
require_once __DIR__.'/../db/tasks/user.php';

$message1 = "";
$message2 = "";

// empêche d'accéder via url si l'utilisateur n'est pas admin
// Pas mis dans un fichier à part comme le sessionCheck vu qu'il n'est utilisé qu'ici
if ($_SESSION['role'] !== 'admin') {
    header("Location: /index.php");
    exit;
}

// à l'envoi d'un formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ajout d'un utilisateur
    if (isset($_POST['add'])) {
        // Récupération infos formulaire
        $username = $_POST['newUsername'];
        $password = $_POST['newPassword'];
        $mail = $_POST['newMail'];
        $role = $_POST['newRole'];
        $name = $_POST['newName'];
        $surname = $_POST['newSurname'];

        if (!empty($username) && !empty($password) && !empty($mail) && !empty($role) && !empty($name) && !empty($surname)) {
            $success = createUser($username, $password, $mail, $role, $name, $surname);
            if ($success) {
                $message1 = "L'utilisateur a été ajouté.";
            } else {
                $message1 = "Erreur lors de l'enregistrement de l'utilisateur.";
            }
        } else {
            $message1 = "Il vous manque des champs pour l'utilisateur que vous avez tenté d'ajouter.";
        }
    }
    else {
        $userId = $_POST['userId'];
        // Mise à jour d'un utilisateur
        if (isset($_POST['update'])) {
            
            if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['mail']) && !empty($_POST['role']) && !empty($_POST['name']) && !empty($_POST['surname'])) {
                $success = updateUser($userId, $_POST['username'], $_POST['password'], $_POST['mail'], $_POST['role'], $_POST['name'], $_POST['surname']);
                if ($success) {
                    $message2 = "L'utilisateur à été mis à jour.";
                } else {
                    $message2 = "Erreur lors de la mise à jour du profil.";
                    }
            } else {
                $message2 = "Il vous manque des champs pour l'utilisateur que vous avez tenté de modifier.";
            }
        }
        // Suppression d'un utilisateur
        elseif (isset($_POST['delete'])) {
            $success = deleteUser($userId);
            if ($success) {
                $message2 = "L'utilisateur à été supprimé.";
            } else {
                $message2 = "Erreur lors de la suppression de l'utilisateur.";
            }
        }
    }
}

// récupération des utilisateurs en db
$users = getUsers();
?>

<h1>Gestion des utilisateurs</h1>

<?php
//reprise du formulaire du userProfilePage mais sans être prérempli
?>
<h2>Ajouter un nouvel utilisateur</h2>
<form action="adminUserManagmentPage.php" method="post">
    <input type="hidden" name="add" value="1">
    Username: <input type="text" name="newUsername"><br>
    Nom: <input type="text" name="newName"><br>
    Prénom: <input type="text" name="newSurname"><br>
    Mot de passe: <input type="password" name="newPassword"><br>
    Mail: <input type="text" name="newMail"><br>
    Role: 
    <select name="newRole">
        <option value="utilisateur">Utilisateur</option>
        <option value="admin">Admin</option>
    </select><br>
    <input type="submit" value="Ajouter un utilisateur">
</form>

<?php echo $message1 ?>

<h2>Liste des utilisateurs</h2>
<table>
    <tr>
        <th>Username</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Mot de passe</th>
        <th>Mail</th>
        <th>Role</th>
        <th></th>
    </tr>
    <?php 
    //Boucle les utilisateurs pour les modifiés/supprimés, je n'ai cependant pas réussi à en affiché un nombre limité (pagination)
    foreach ($users as $user): ?>
    <form action="adminUserManagmentPage.php" method="post">
        <input type="hidden" name="userId" value="<?php echo $user['userId']; ?>">
        <tr>
            <td><input type="text" name="username" value="<?php echo $user['username']; ?>"></td>
            <td><input type="text" name="name" value="<?php echo $user['name']; ?>"></td>
            <td><input type="text" name="surname" value="<?php echo $user['surname']; ?>"></td>
            <td><input type="password" name="password" value=""></td>
            <td><input type="text" name="mail" value="<?php echo $user['mail']; ?>"></td>
            <td>
                <select name="role">
                    <option value="utilisateur" <?php echo ($user['role'] == 'utilisateur') ? 'selected' : ''; ?>>Utilisateur</option>
                    <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                </select>
            </td>
            <td>
                <input type="submit" name="update" value="Mettre à jour">
                <input type="submit" name="delete" value="Supprimer">
            </td>
        </tr>
    </form>
    <?php endforeach; ?>
</table>

<?php echo $message2 ?>

</body>
</html>