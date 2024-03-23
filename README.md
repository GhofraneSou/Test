Creation un Projet Laravel avec Vue 3

Le projet consiste en une application de gestion de tâches, fusionnant Laravel en backend avec Vue 3 en frontend. 
Les fonctionnalités incluent la création, l'affichage, la modification, la suppression et le marquage des tâches comme compléte. 
Grâce à Laravel, une API est mise en place pour gérer les opérations CRUD sur les tâches. 
Vue 3 offre une interface utilisateur interactive, avec datatables.net pour une visualisation fluide des tâches.
 Le filtrage des tâches permet aux utilisateurs de trier entre tout complete et incomplete facilitant ainsi la gestion de leur liste de tâches.

Prérequis


Composer pour la gestion des dépendances PHP de Laravel.
Node.js pour l'exécution de scripts JavaScript, y compris Vue.js.
npm (fourni avec Node.js) pour la gestion des dépendances JavaScript.
Étapes pour Créer le Projet

1:composer create-project laravel/laravel to_do_list
2:Installer Vue 3 via npm
3: installation vite : npm install -g vite@latest
Compiler les Ressources :npm run dev

Construction pour la Production:npm run build
Lancer le Serveur Laravel:php artisan serve
lancement de l'application: 
1:npm install 
2:npm run dev
3: php artisan optimize
3 php artisan serve
le projet contient un fichier de base de données
