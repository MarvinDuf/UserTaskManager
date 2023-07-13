# Task Manager

Ce projet est une simple application de gestion de tâches utilisant PHP pour le côté serveur et HTML pour l'interface utilisateur.

## Fonctionnalités

* Gestion des utilisateurs (authentification, création, mise à jour et suppression)
* Gestion des projets (création, mise à jour et suppression) _(work in progress)_
* Gestion des tâches associées aux projets (création, mise à jour et suppression) **(work in proress)**
* Gestion des commentaires sur les tâches (création, mise à jour et suppression) **(work in progress)**

## Comment démarrer

1. Clonez le dépôt dans votre environnement local.
2. Ouvrez celui-ci avec votre IDE et l'environnement DOCKER.
3. Associez un port à l'application afin de pouvoir y accéder via votre navigateur.
4. Assurez-vous que WAMP_SERVER est installer et lancé.
5. Créez une base de données et importez le fichier `src/databaseScript.sql`.
6. Modifiez le fichier `src/database.php` pour y inclure vos informations de connexion à la base de données.
7. Connectez vous avec les identifiants : admin admin

## Structure des fichiers

* `db/`: contient les fichiers de configuration de la base de données.
* `db/tasks`: contient les requêtes pour d'accès à la base de données.
* `src/`: contient les fichiers PHP et HTML pour la page de gestion des utilisateur et la page de gestion de profil.
* `src/authentification`: contient les fichiers PHP et HTML pour la page de connexion et l'authentification de l'utilisateur.
* `src/layout`: contient les fichiers PHP et HTML pour les éléments redondants (header/footer/navbar) trouvable sur chaque pages.
