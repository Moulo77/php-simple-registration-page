# Mise en place de la page web
## Prérequis
Tout d'abord, il faudra installer [Docker Desktop](https://www.docker.com/products/docker-desktop/), puis le lancer.

## Lancement du projet
Se placer à la racine du projet, et faire la command `docker-compose up --build`.
Les différents éléments vont s'installer et se lancer.
Une fois le chargement terminé, rendez-vous sur votre localhost (http:\\localhost).

## Spécificités des éléments de sécurité
- Utilisation de requêtes préparées : Cela protège le formulaire des injections sql
- Utilisation de bcrypt : C'est un algorithme de hachage lourd en calcul, ce qui le rend résistant au brutforce.
- Obligation pour l'utilisateur d'utiliser un mot de passe sécurisé
- Compteur d'essais pour empecher le brutforce