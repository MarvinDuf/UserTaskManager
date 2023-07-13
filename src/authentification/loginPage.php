<!DOCTYPE html>
<html>
<head>
    <title>Page de connexion</title>
</head>
<body>

<?php
session_start();

//Empêche d'accéder à la page via l'url si l'utilisateur est connecté
if(isset($_SESSION['username'])){
    header("Location: /index.php");
    exit;
}

$message = "";
// méthode exectuée à l'envoi du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //récup des infos du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    //récupération de l'utilisateur en base (via username)
    require_once __DIR__.'/../../db/tasks/user.php';
    $user = getByUserName($username);

    if ($user) {
        //check du mdp renseigné avec celui haché en db
        if (password_verify($password, $user['password'])) {
            //enregistrement des infos de l'utilisateur dans la session (pas le mdp et mail par sécurité ?)
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            $_SESSION['userId'] = $user['userId'];
            $_SESSION['name'] = $user['name'];;
            $_SESSION['surname'] = $user['surname'];;

            header("Location: /index.php");
        }
    }
    //si la connexion réussie, l'utilisateur n'a pas le temps de voir le message (ligne non executee)
    $message = "Nom d'utilisateur ou mot de passe incorrect.";
}
?>

<h1>Veuillez vous connecter pour accéder au Task Manager</h1>

<form action="loginPage.php" method="post">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit">
</form>

<?php
    echo "<p>$message</p>";
?>

</body>
</html>