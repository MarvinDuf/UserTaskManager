<nav>
  <ul>
    <li><a href="/index.php">Page principale</a></li>
    <li><a href="/src/userProfilePage.php">Gérer mon profil</a></li>
    <?php
    if(isset($_SESSION['username'])){
      //même que pour l'index et le userProfilePage, sauf que php nécessaire pour la variable de la session (du coup echo)
      echo '<li><a href="/src/authentification/logout.php">Déconnexion ('. $_SESSION['username'] .')</a></li>';
    }
    if ($_SESSION['role'] == 'admin') {
      //Ne s'affiche pas si l'utilisateur connecté n'est pas admin
      echo '<li><a href="/src/adminUserManagmentPage.php">Gestion des utilisateurs (Admin)</a></li>';
    }
    ?>
  </ul>
</nav>