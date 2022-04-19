# FRAMEWORK / CMS
### Par Julien Delusseau

Il s'agit d'un framework PHP 7.4 "from scratch".

## Fonctionnalités:
- CRUD utilisateurs
- CRUD articles
- CRUD commentaires
- Catégories pour chaque article
- Rôles pour chaque utilisateur (admin, lecteur et auteur)
- Login & Register
- Mot de passe oublié
- Pagination
- Un système de message flash
- Un système de redirection
- Un système d'envoi d'emails
- Différents thèmes

## Mise en service:
- Remplir le fichier _configs/config.php avec vos données propres

## Router:
Pour créer une route, il faut
- créer un controller dans le dossier src
- exemple #1 : pour créer une route '/videos', créer un controller nommé 'VideosController'
- exemple #2 : pour créer une route '/voiture', créer un controller nommé 'VoitureController'
- le router va analyser les méthodes se trouvant à l'intérieur du controller
- la méthode par défaut sera la méthode index()
- la route '/voiture' invoquera la méthode index() dans 'VoitureController'
- la route '/voiture/add' invoquera la méthode add() dans 'VoitureController'
- chaque méthode peur également recevoir un paramètre
- La route '/voiture/update/toyota' recevra la string 'toyota' en paramètre.
- Chaque méthode peut générer une view, grâce à la méthode generateView(), hérité de sa classe parente MainController.
- Chaque view doit se trouver dans le dossier 'views'
- La méthode generateView() accepte un array comme paramètre, par exemple pour passer le titre ou toute information supplémentaire.

## Suppléments:
Le controller 'Toolbox' comporte quelques fonctionnalités en plus, telles que l'envoi d'email et la création de messages flash.