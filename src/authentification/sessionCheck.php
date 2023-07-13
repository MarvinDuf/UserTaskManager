<?php
//à require sur chaque page, empêche l'accès via url quand l'utilisateur n'est pas connecté
session_start();

if(!isset($_SESSION['username'])){
    header("Location: /src/authentification/loginPage.php");
    exit;
}