# GEMINI.md

# Présentation du projet

Movie Platform est une plateforme de gestion de films.

Périmètre actuel :
- Gérer les genres de films.
- Afficher les genres existants.
- Ajouter de nouveaux genres.

---

# Architecture

Le projet utilise une architecture séparant le frontend et le backend :

```text
movie/
├── frontend/
│   ├── index.html
│   └── genre.js
│
└── backend/
    ├── api/
    │   └── genre-api.php
    ├── classes/
    │   └── Genre.php
    └── data/
        └── genres.json
```

## Frontend

- `index.html` → interface d'administration.
- `genre.js` → logique frontend et communication avec l'API.
- Tailwind CSS → mise en forme de l'interface.

## Backend

- `genre-api.php` → point d'entrée de l'API.
- `Genre.php` → logique métier liée aux genres.
- `genres.json` → stockage des données.

## Flux de données

```text
Frontend
   ↓
genre.js
   ↓
genre-api.php
   ↓
Genre.php
   ↓
genres.json
```

---

# Technologies utilisées

## Frontend

- HTML
- JavaScript
- Tailwind CSS
- Fetch API

## Backend

- PHP
- PHP OOP
- PHP API

## Stockage

- JSON

---

# Règles générales

- Respecter l'architecture existante.
- Maintenir la séparation entre le frontend et le backend.
- Utiliser JavaScript pour la logique frontend.
- Utiliser PHP pour la logique backend.
- Utiliser la POO en PHP pour la logique métier.
- Utiliser l'API existante pour la communication entre le frontend et le backend.
- Valider les données reçues par l'API.
- Retourner les réponses de l'API au format JSON.
- Préserver la structure JSON existante.
- Réutiliser le code existant lorsque cela est possible.
- Ne pas introduire de technologies inutiles.
- Ne pas modifier les fichiers qui ne sont pas concernés.
- Préserver les fonctionnalités existantes.

---

# Processus de travail

Pour chaque tâche :

1. Comprendre la demande.
2. Examiner les fichiers concernés.
3. Comprendre le fonctionnement actuel.
4. Identifier les fichiers à modifier.
5. Planifier les modifications.
6. Implémenter les changements.
7. Tester la fonctionnalité concernée.
8. Vérifier que les fonctionnalités existantes fonctionnent toujours.
9. Présenter les modifications effectuées et les vérifications réalisées.

---

# Commandes

Démarrer le serveur de développement :

```bash
php -S localhost:8000
```

---

# Conventions de développement

## Frontend

- Garder la structure dans les fichiers HTML.
- Garder le comportement dans les fichiers JavaScript.
- Utiliser `fetch()` pour communiquer avec l'API.
- Utiliser JSON pour les données échangées avec l'API.
- Gérer les erreurs de l'API.

## Backend

- Garder les endpoints API dans `backend/api/`.
- Garder les classes dans `backend/classes/`.
- Utiliser la POO en PHP.
- Valider les données reçues.
- Retourner les réponses au format JSON.

## Données

- Conserver les données des genres dans `genres.json`.
- Préserver la structure actuelle des données.
- Conserver la logique actuelle de génération des identifiants.

---

# Tests

Vérifier que :

- Le frontend se charge correctement.
- L'API est accessible.
- Les genres sont affichés.
- Un genre valide peut être ajouté.
- Un nom de genre vide est refusé.
- Les réponses de l'API sont au format JSON valide.
- Les nouveaux genres sont correctement enregistrés.
- Les fonctionnalités existantes fonctionnent toujours.

---

# Utilisation des Skills

Les Skills contiennent les procédures détaillées pour certains types de tâches.

Lorsqu'une tâche correspond à un Skill :

1. Identifier le Skill approprié.
2. Lire ses instructions avant de commencer l'implémentation.
3. Suivre le processus défini par le Skill.
4. Respecter les règles et l'architecture du projet pendant son utilisation.
5. Utiliser uniquement les Skills pertinents pour la tâche.
6. Si plusieurs Skills sont nécessaires, les utiliser dans l'ordre approprié.
7. Ne pas dupliquer les instructions des Skills dans ce fichier.
