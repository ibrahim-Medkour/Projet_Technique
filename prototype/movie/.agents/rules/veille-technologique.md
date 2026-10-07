---
trigger: model_decision
description: Veille technologique et évaluation des évolutions pour la stack Movie Platform
---

# Règles de Veille Technologique - Movie Platform

Règles et critères de décision pour encadrer la veille technologique du projet et évaluer ses évolutions sans introduire de complexité inutile.

## 1. Domaines surveillés (Stack réelle)

- **Frontend** : JavaScript natif (ES, Fetch API), HTML sémantique, Tailwind CSS.
- **Backend** : PHP (versions supportées, POO moderne, conception d'API REST légères).
- **Stockage & Données** : Manipulation, validation et intégrité des fichiers JSON (`genres.json`).
- **Environnement & Sécurité** : Serveur CLI PHP (`php -S`), sécurité des endpoints API (validation des entrées, codes HTTP, CORS).

## 2. Sources fiables prioritaires

- Documentations et spécifications officielles : [php.net](https://www.php.net), [tailwindcss.com](https://tailwindcss.com), [MDN Web Docs](https://developer.mozilla.org).
- Dépôts et changelogs officiels (notes de version GitHub des outils utilisés).
- Standards du web (WHATWG, W3C) et RFC PHP officielles.
- Bulletins de sécurité et avis officiels (CVE, advisories PHP/Tailwind).

## 3. Critères d'évaluation

- **Adéquation architecturale** : Respect strict de la séparation frontend/backend et de la POO en PHP.
- **Bénéfice concret** : Amélioration mesurable de la sécurité, de la maintenabilité, de la robustesse ou des performances.
- **Maturité & Stabilité** : Version stable et éprouvée, supportée activement par la communauté.
- **Frugalité technique** : Pas de framework lourd ni de dépendance superflue (principe de simplicité de `GEMINI.md`).

## 4. Contraintes de veille

- Respecter l'architecture et les règles de `GEMINI.md` : préserver la persistance JSON actuelle et la logique de données sans sur-ingénierie.
- Privilégier les solutions natives (Vanilla JS, fonctions natives PHP) avant d'envisager tout nouvel outil.
- Préserver la compatibilité avec l'environnement de développement existant (`php -S localhost:8000`).

## 5. Filtrage des informations

- **Vérification systématique** : Recouper toute information avec la documentation officielle ou le changelog du projet source.
- **Exclusion de l'obsolète** : Vérifier la date de parution et écarter les pratiques ou fonctionnalités dépréciées.
- **Rejet du buzz et du hors-sujet** : Écarter les tendances disproportionnées pour le projet (ex. frameworks fullstack, ORM lourds, build tools non requis).


## 6. Grille de décision

- **Adopter** : Évolution stable, apportant un gain prouvé (sécurité, simplification, robustesse), 100 % compatible avec l'architecture existante et à faible coût d'intégration.
- **Surveiller** : Nouveauté pertinente ou standard prometteur mais manquant de recul, ou évolution adaptée à une étape future (ex. migration du stockage JSON vers une base de données relationnelle si le volume augmente).
- **Rejeter** : Rupture architecturale, complexité disproportionnée, dépendances superflues, instabilité ou source non vérifiable.