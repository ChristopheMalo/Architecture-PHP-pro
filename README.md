# MicroCMS

Évoluez vers une architecture PHP professionnelle

Conception et développement d'un micro-CMS selon SCRUM (méthode agile)

Partie 1 - Initialisation de l'application (Itérations 1, 2 et 3)

Partie 2 - Refactorisation de l'architecture (Itérations 4, 5, 6 et 7)

Partie 3 - Sécurité et administration (Itérations 8, 9 et 10)

**Attention :** les fichiers database.sql, config/dev.php et config/prod.php utilisent un user et pass qui sont génériques. Il faut les adapter selon votre configuration. N'utilisez pas ces données sur un serveur de production. Pensez à les modifier.

## Les itérations
### Itération 1
- Création de la base de données
- Affichage de la liste des articles

### Itération 2
- Séparer les responsabilités
- Le modèle MVC

### Itération 3
- Intégrer le framework Silex à l'application
- Utiliser composer pour installer Silex (Vendor n'est pas envoyé sur le repository)
- Refactoriser l'application existante
- Réécrire l'application avec Silex

### Itération 4
- Modélisation objet de l'accès aux données (le domaine)
- Remplacer PDO par Doctrine DBAL

### Itération 5
- Améliorer la technologie d'affichage de l'application
- Intégrer un moteur de templates : Twig

### Itération 6
- Intégrer le framework twitter bootstrap
- Intégrer jQuery
- Coder la vue index avec Bootstrap

### Itération 7
- Ajout d'une fonctionnalité métier : permettre au visiteur de consulter les détails d'un article en cliquant sur son titre
- MAJ de la DB - intégrer des commentaires
- MAJ des fichiers de l'application

### Itération 8
- Mettre en place un système d'identification pour les utilisateurs
- Gestion de la sécurité
- Gestion des mots de passe
- Sécurisation de l'application

### Itération 9
- Ajout de commentaires à un article

### Itération 10
- Mettre en place le back-office pour administrer l'application
  - Affichage des articles, commentaires et utilisateurs de l'application
  - Modification et suppression d'un article, d'un commentaire ou d'un utilisateur
  - Ajout d'un nouvel article ou d'un nouvel utilisateur
- Coder la page d'accueil admin
- Coder les pages de gestion des articles, des commentaires et des utilisateurs sous forme d'onglets

### Itération 11
- Préparer le site pour la production
- Ajout de tests fonctionnels
- Journalisation et débogage
- Gestion des erreurs
- Mise en production

### Itération 12
- Ajout d'une API JSON
- Création de l'API de consultation, de modification
- Mise à jour des tests fonctionnels

### Itération 13
- Réorganiser les contrôleurs (accueil, administration et API)
- Réécritures des routes

## Fichiers à renommer
### Itération 1
- index_sample.php -> index.php

### Itération 2 et 3
- model_sample.php -> model.php

### Itération 4, 5, 6, 7, 8, 9, 10, 11, 12
- app/config/prod_sample.php -> app/config/prod.php

## Copyright
**Inspiré par :** [un cours Openclassrooms - de Baptiste Pesquet](https://openclassrooms.com/courses/evoluez-vers-une-architecture-php-professionnelle) - **Adaptation :** Christophe Malo