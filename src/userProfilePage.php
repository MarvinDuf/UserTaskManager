<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
</head>
<body>

<?php
require_once __DIR__.'/authentification/sessionCheck.php';
require_once __DIR__.'/layout/header.php';
require_once __DIR__.'/../db/tasks/user.php';

$message = "";

// méthode exectuée à l'envoi du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //récupération champs
    $username = $_POST['username'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $password = $_POST['password'];
    $mail = $_POST['mail'];

    // check que toute les données sont présentes
    if(empty($username) || empty($name) || empty($surname) || empty($password) || empty($mail)) {
        $message = "Veuillez remplir tous les champs.";
    } else {
        //pour le user id, j'aurais aussi pu le prendre via un hidden input dans le formulaire, je l'ai pris dans la session étant donné que c'est déjà à dispo
        $success = updateUser($_SESSION['userId'], $username, $password, $mail, $_SESSION['role'], $name, $surname);

        if ($success) {
            //Mise à jour de l'username pour ne pas avoir à le déconnecter
            $_SESSION['username'] = $username;
            $message = "Profil mis à jour.";
        } else {
            $message = "Erreur lors de la mise à jour du profil.";
        }
    }
}

// récup des infos depuis la db (via la session)
$user = getByUserName($_SESSION['username']);
?>

<h1>Profil de l'utilisateur</h1>

<?php echo 'Vous êtes connecté en tant qu\' '. $user['role'] ?>

<form action="userProfilePage.php" method="post">
    Username: <input type="text" name="username" value="<?php echo $user['username']; ?>"><br>
    Nom: <input type="text" name="name" value="<?php echo $user['name']; ?>"><br>
    Prénom: <input type="text" name="surname" value="<?php echo $user['surname']; ?>"><br>
    Mot de passe: <input type="password" name="password" value=""><br>
    Mail: <input type="text" name="mail" value="<?php echo $user['mail']; ?>"><br>
    <input type="submit" value="Mettre à jour mes informations">
</form>

<?php echo $message; ?>

</body>
</html>