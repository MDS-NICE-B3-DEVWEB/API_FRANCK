# API_FRANCK | Création d'une API REST

## Informations générales
- Nom du projet : API_FRANCK
- Date du projet : 20/12/2023
- Résumé : Création d'une API REST en Laravel

VERSION LOCAL

## Objectifs du TP API REST
- Créer une API en respectant l'architecture REST
- Créer une base de données
- Créer un client web (front-end) pour tester l'API REST (Front-end optionnel)
- Utilisation d'une ORM (Object Relational Mapping) pour la base de données (récommandé)
- Utilisation d'un framework pour l'API REST (récommandé)
- Utilisation de Docker pour l'API REST et la base de données (récommandé)

## Méthodologie d'évaluation
Afin de réaliser l'évaluation, je vais utiliser les outils suivants :
- [Postman](https://www.postman.com/) pour tester les fonctionnalités de l'API web
- [Wireshark](https://www.wireshark.org/) pour analyser le trafic réseau
- [Docker](https://www.docker.com/) pour exécuter l'API web et la base de données

Personnellement durant le developement de l'application j'ai préferer utiliser le logiciel [Insomnia](https://insomnia.rest) pour tester les fonctionnalités de l'API web

## Rappels des normes Respectées
- Format de données : JSON /2pts
- API CRUD : Create, Read, Update, Delete /2pts
- Méthodes HTTP : GET, POST, PUT, DELETE /2pts
- Codes de statut HTTP : 200, 201, 204, 400, 401, 403, 404, 405, 409, 500 (respect de la norme RFC 7807) /2pts
- Norme de nommage des routes (GetUser, PostUser, PutUser, DeleteUser) /2pts
- Authentification : Token JWT ou Baraer Token ou équivalent 2/pts 
- Application Statelessness /2pts
- Horodatage des données : ISO 8601 /2pts
- Documentation de l'API : Swagger ou équivalent ou en md /2pts
- Front et Back indépandant /4pts 
- [Bonus] : API containerisée / Pretty URLs / API versioning / Frontend esthétique / Obligé un mot de passe fort / Bloqué les origine inconnue / Hébergé sur un server en HTTPS
- [ATTENTION] : La note peut être divisée par 2 si le code est illisible ou mal structuré ou que le projet n'est pas cohérent

## Architecture du Projet

### Voici la structure du projet ainsi qu'une brève expliquation des differents dossier et fichier :

- Voici ou se trouve les controllers qui permet de traiter les requetes suivant la routes choisi : 
``` app\Http\Controllers\Api ```
- Voici ou se trouve les requêtes qui definissent les regles a suivre pour les éléments : 
``` app\Http\Requests ```
- Voici ou se trouve les models qui permet de crée les differents éléments : 
``` app\Models ```
- Voici ou se trouve les migrations qui permettent la génération dans la base de données : 
``` database\migrations ```
- Voici ou se trouve les routes de l'api qui definit donc les routes de l'api :
``` routes\api.php ```

### Voici les étapes a suivre pour installer le projet :

1. Clonez ce référentiel sur votre machine locale.

   ```bash
      git clone https://github.com/MDS-NICE-B3-DEVWEB/API_FRANCK
    ```

2. Créez un fichier `.env` à la racine du projet et ajoutez les variables suivantes.

   ```bash
      PORT=<port de votre application>
      DB_TYPE=<type de votre SGBD mysql,mariadb,postgresql etc...>
      DB_HOST=<hôte de votre base de données>
      DB_USER=<utilisateur de votre base de données>
      DB_PASS=<mot de passe de votre base de données>
      DB_NAME=<nom de votre base de données>
    ```

3. Créez une base de données MariaDB ou autre type de SGBD SQL avec le nom que vous avez spécifié dans le fichier `.env`.

4. Exécutez les migrations.

   ```bash
      php artisan migrate```

5. Exécutez l'appication.

   ```bash
      php artisan serve```

## Routes

Voici les routes disponible qui vous permette de tester vos requetes via l'API

### Utilisateurs

Permet la gestion des utilisateurs

- Crée un utilisateur : 
``` POST    /register ```
- Se connecter : 
``` POST    /login ```
- Recuperer les informations de l'utilisateur connecté :  
``` GET     /user ```
- Modifier les informations de l'utilisateur connecté : 
``` PUT     /user/edit ```
- Suprimer le compte de l'utilisateur connecté: 
``` DELETE  /user/delete ```

### Posts

Permet la gestion des posts

- Recuperer la liste des posts :  
``` GET     posts ```
- Ajouter un post : 
``` POST    posts/create ```
- Editer un post : 
``` PUT     posts/edit/{post} ```
- Suprimer un post :
``` DELETE  posts/delete/{post} ```

### Rubriques

Permet la gestion des rubriques

- Recuperer la liste des rubriques :  
``` GET     rubriques ```
- Ajouter une rubrique : 
``` POST    rubriques/create ```
- Editer une rubrique : 
``` PUT     rubriques/edit/{post} ```
- Suprimer une rubrique :
``` DELETE  rubriques/delete/{post} ```


