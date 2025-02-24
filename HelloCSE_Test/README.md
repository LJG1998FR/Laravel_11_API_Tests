## Readme

## Versions utilisées

- Laravel : 11.31
- PHP : 8.2.1

## Installation du projet

Lancer les commandes suivantes:
- ``` composer install ``` pour installer les dépendances de Composer
- ``` php artisan key:generate --ansi ``` pour créer les clés de chiffrement (notamment des mots de passe des admins)
- ``` php artisan migrate --seed ``` pour générer les tables de la base de données avec des données pré-définies

## Lancer le serveur

- ``` php artisan serve ``` pour lancer le serveur de dev intégré à Laravel

## Migrations

Le projet contient 3 fichiers de migrations (situés dans database/migrations) pour générer les tables de la base de données

## Seeders

Le projet contient 2 seeders:
- DefaultAdminsSeeder pour les administrateurs
- DefaultUsersSeeder pour les utilisateurs

## Endpoints
- api/getActiveUsers: public, permet de récupérer l’ensemble des profils uniquement dans le statut "actif"
- api/storeNewUser: protégé par authentification, permet de créer une entité "user".
- api/updateUser: protégé par authentification, permet de modifier une entité user
- api/deleteUser: protégé par authentification, supprimer de modifier une entité user

Tous les endpoints renvoient un array sous la forme:

```
    [
        "success" => true|false,
        "data" => mixed,
    ]

```

## Tests

Il y a 3 fichiers de tests, situés dans tests/Features:
- GetActiveUsersTests: teste l'endpoint api/getActiveUsers
- StoreNewUserTest: teste l'endpoint api/storeNewUser
- UpdateUserTest: teste l'endpoint api/updateUser