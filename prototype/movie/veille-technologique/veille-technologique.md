# Veille Technologique - Movie Platform

**Date :** 7 octobre 2026  
**Auteur :** Antigravity AI Pair Programmer  
**Projet :** Movie Platform (Prototype de gestion des genres de films)  
**Document cadre :** Conforme à la méthodologie de [.agents/skills/veille-technologique/SKILL.md](file:///c:/Users/Solicode/solicode_2026/Projet_Technique/prototype/movie/.agents/skills/veille-technologique/SKILL.md) et aux critères de [.agents/rules/veille-technologique.md](file:///c:/Users/Solicode/solicode_2026/Projet_Technique/prototype/movie/.agents/rules/veille-technologique.md).

---

## 1. Compréhension du besoin

### 1.1 Contexte du projet
Le projet **Movie Platform** est un prototype séparant strictement le frontend du backend :
- **Frontend** : Interface HTML5, styles Tailwind CSS (via CDN Play), logique client en JavaScript natif (Fetch API).
- **Backend** : API REST légère en PHP procédural/routeur (`genre-api.php`), logique métier encapsulée dans une classe orientée objet (`Genre.php`), servi via le serveur intégré `php -S localhost:8000`.
- **Stockage** : Persistance sous forme de fichier JSON (`genres.json`).

### 1.2 Objectif de la veille
L'objectif est d'identifier les évolutions récentes et éprouvées de la stack réelle afin de :
1. Renforcer la robustesse, la sécurité et l'intégrité des données sans ajouter de complexité.
2. Moderniser l'écriture du code (JavaScript ES moderne, PHP 8.3+) dans le respect des fonctionnalités natives.
3. Éviter l'introduction prématurée de dépendances ou d'outils surdimensionnés conformément à la règle de frugalité définie dans [GEMINI.md](file:///c:/Users/Solicode/solicode_2026/Projet_Technique/prototype/movie/GEMINI.md).

---

## 2. Définition du périmètre de surveillance

Conformément aux règles du projet, les axes de surveillance portent exclusivement sur la stack réelle existante :

| Domaine | Technologie actuelle | Composants à surveiller | Axes prioritaires |
| :--- | :--- | :--- | :--- |
| **Frontend** | Vanilla JS (Fetch), HTML5 | `index.html`, `genre.js` | Syntaxe moderne (`async/await`), prévention XSS, accessibilité DOM |
| **Styling** | Tailwind CSS (CDN Play) | `index.html` (balise `<script>`) | Évolution Tailwind CSS v4, gestion des CDN vs compilation sans Node |
| **Backend** | PHP 8.5 (CLI), POO | `genre-api.php`, `Genre.php` | Nouveautés PHP 8.3/8.4/8.5 (`json_validate`, constructeur promu, `array_*`) |
| **Stockage** | JSON (`genres.json`) | `file_get_contents`, `file_put_contents` | Concurrence d'accès (`LOCK_EX`), intégrité et gestion d'erreurs |
| **Sécurité & API**| HTTP REST | Endpoints API et échanges JSON | Codes HTTP réels (200, 400, 405), assainissement et validation des données |

---

## 3. Recherches d'informations récentes

Les recherches ont été conduites sur les versions récentes stables des technologies de la stack :

### 3.1 Backend & Écosystème PHP (PHP 8.3 / 8.4 / 8.5)
- **Fonction `json_validate()` (introduite en PHP 8.3)** : Permet de valider la conformité syntaxique d'une chaîne JSON sans instancier de structure en mémoire (contrairement à `json_decode()`). Réduit l'empreinte mémoire et sécurise la lecture des requêtes `php://input`.
- **Fonctions natives de manipulation de tableaux (PHP 8.4)** : Introduction de `array_find()`, `array_find_key()`, `array_any()` et `array_all()`. Elles permettent d'éviter les boucles manuelles lors de la vérification d'unicité (ex. tester si un genre existe déjà dans la liste).
- **Constructeur promu et modificateurs `readonly` (PHP 8.1+)** : Permet de déclarer et d'initialiser les propriétés typées directement dans les paramètres du constructeur (`public function __construct(private readonly string $nom) {}`), réduisant le boilerplate de la classe `Genre`.
- **Levée d'exceptions JSON natives** : Utilisation du flag `JSON_THROW_ON_ERROR` dans `json_decode()` et `json_encode()` pour capter immédiatement les erreurs de parsing plutôt que de retourner silencieusement `null` ou `false`.

### 3.2 Frontend & JavaScript natif (ES2022 - ES2024)
- **Migration vers `async/await` et `try...catch`** : Simplifie la chaîne de promesses `.then().then().catch()` dans `genre.js`, rend le code asynchrone plus lisible et facilite la gestion d'erreurs centralisée.
- **Traitement des codes de statut Fetch API** : La Fetch API ne rejette pas une promesse sur une erreur 4xx ou 5xx. Il est indispensable d'évaluer la propriété `response.ok` avant de consommer la réponse JSON.
- **Sécurisation du rendu DOM** : L'utilisation actuelle de `ligne.innerHTML = ...` expose à des vulnérabilités potentielles de type Cross-Site Scripting (XSS) si une chaîne non assainie est injectée. L'utilisation de `document.createElement()` couplée à `textContent` (ou `element.append()`) offre une protection native sans aucune bibliothèque externe.

### 3.3 Styling : Tailwind CSS (v3 vs v4)
- **Tailwind CSS v4.0** : Sorti en janvier 2025, Tailwind v4 introduit une configuration CSS-first sans fichier `tailwind.config.js` et s'appuie sur le moteur Lightning CSS.
- **Limitation du CDN Play actuel** : L'utilisation de `<script src="https://cdn.tailwindcss.com"></script>` est officiellement déconseillée en production par l'équipe Tailwind (réservée au bac à sable et au prototypage). Tailwind propose un binaire autonome (*standalone CLI*) exécutable sans dépendance à l'écosystème Node.js/npm.

### 3.4 Persistance & Concurrence sur fichiers JSON
- **Protection contre les conditions de concurrence (*race conditions*)** : En cas de requêtes simultanées, `file_put_contents()` sans verrouillage peut corrompre `genres.json`. L'utilisation du flag natif `LOCK_EX` garantit une écriture exclusive.

---

## 4. Sources fiables consultées et filtrage

### 4.1 Sources de référence
Les informations retenues proviennent exclusivement de documentations de référence et de dépôts officiels :
- **PHP** : [Documentation officielle php.net](https://www.php.net) (RFC PHP 8.3 `json_validate`, RFC PHP 8.4 `array_find`, manuel des fonctions JSON).
- **Mozilla Developer Network (MDN)** : [MDN Web Docs](https://developer.mozilla.org) (Spécification Fetch API, prévention XSS et manipulation sécurisée du DOM).
- **Tailwind CSS** : [Documentation officielle tailwindcss.com](https://tailwindcss.com) (Notes de version v4.0 et guide d'intégration autonome).
- **Sécurité Web** : Référentiels OWASP (Cross-Site Scripting prevention cheat sheet, REST Security basics).

### 4.2 Filtrage des informations non pertinentes
Conformément aux directives de veille :
- **Rejet du buzz et des frameworks superflus** : Les suggestions de passage à React, Vue, Next.js, ou l'utilisation d'ORM comme Doctrine ou de frameworks comme Laravel/Symfony ont été systématiquement écartées car en contradiction directe avec [GEMINI.md](file:///c:/Users/Solicode/solicode_2026/Projet_Technique/prototype/movie/GEMINI.md).
- **Rejet des bundlers Node.js complexes** : L'intégration d'outils de build (Webpack, Vite, Babel) nécessitant un `package.json` et des centaines de modules npm a été écartée pour préserver l'exécution fluide et légère du prototype.
- **Rejet des tutoriels obsolètes** : Élimination des pratiques basées sur XMLHttpRequest ou des syntaxes PHP antérieures à la version 8.

---

## 5. Analyse des évolutions techniques

| Évolution | État actuel du projet | Proposition d'évolution | Bénéfice technique | Coût / Risque |
| :--- | :--- | :--- | :--- | :--- |
| **Validation JSON (`json_validate`)** | `json_decode()` direct sur les entrées brutes | Contrôle préalable via `json_validate(file_get_contents('php://input'))` | Économie de mémoire, détection précoce des requêtes malformées | Nul (fonction native PHP 8.3+) |
| **Codes HTTP REST réels** | L'API retourne systématiquement 200 OK, même avec `"status": "error"` | Utilisation de `http_response_code(400)` pour les erreurs client et `405` pour les méthodes non autorisées | Respect des standards REST, gestion native côté Fetch via `response.ok` | Très faible (1 ligne PHP) |
| **Écriture atomique JSON** | `file_put_contents($file, $json)` | `file_put_contents($file, $json, LOCK_EX)` | Évite toute corruption du fichier lors de requêtes concurrentes | Nul (argument natif) |
| **POO moderne PHP** | Propriétés privées et affectation manuelle dans le constructeur | Promotion de propriété constructeur : `__construct(private readonly string $nom)` | Moins de boilerplate, immutabilité de la valeur, code plus expressif | Nul (supporté depuis PHP 8.1) |
| **Protection XSS Frontend** | Concaténation de balises dans `innerHTML` | Construction d'éléments avec `createElement` et assignation via `textContent` | Élimination complète des failles d'injection XSS sans dépendance externe | Très faible |
| **Modernisation JS Client** | Chaînage `.then().catch()` | Fonctions `async / await` avec blocs `try ... catch` | Lisibilité accrue, meilleure interception des anomalies réseau | Très faible |
| **Compilateur Tailwind CLI** | CDN Play (`cdn.tailwindcss.com`) dans le `<head>` | Maintien du CDN pour le prototype actuel / Évaluation du CLI autonome pour la suite | Pas de requête externe bloquante au runtime | Nécessite un fichier binaire ou une étape de génération |

---

## 6. Évaluation selon les Rules du projet

L'analyse a été confrontée aux règles établies dans [.agents/rules/veille-technologique.md](file:///c:/Users/Solicode/solicode_2026/Projet_Technique/prototype/movie/.agents/rules/veille-technologique.md) et [GEMINI.md](file:///c:/Users/Solicode/solicode_2026/Projet_Technique/prototype/movie/GEMINI.md) :

1. **Séparation Frontend / Backend** : Pleinement respectée. Le frontend continue d'utiliser l'API Fetch sans couplage avec le code PHP.
2. **Utilisation de la POO en PHP** : Respectée et valorisée. Les évolutions de PHP renforcent la classe `Genre.php` avec les standards modernes.
3. **Persistance JSON existante** : Conservée à 100 %. La structure `[{"id": 1, "nom": "action"}]` et la logique de calcul de l'ID (`max(ids) + 1`) restent intactes.
4. **Frugalité et non-introduction de technologies inutiles** : Aucune bibliothèque tierce, aucun framework, aucun gestionnaire de paquets ajouté. Toutes les améliorations reposent sur les capacités natives du langage ou du navigateur.
5. **Compatibilité avec le serveur de développement** : La stack reste intégralement exécutable via `php -S localhost:8000`.

---

## 7. Recommandations et grille de décision

### 7.1 À ADOPTER (Gains immédiats, 100 % natif, zéro dépendance)

Ces évolutions peuvent être intégrées immédiatement dans le code existant :

1. **Backend - Robustesse et sécurité de l'API** :
   - Émettre des codes de statut HTTP appropriés (`http_response_code(400)` sur champ manquant, `http_response_code(405)` sur méthode non supportée, `http_response_code(201)` sur création réussie).
   - Valider la charge utile JSON avec `json_validate()` avant décodage.
   - Sécuriser l'écriture fichier avec le flag `LOCK_EX` dans `file_put_contents()`.
2. **Backend - Modernisation de la classe `Genre`** :
   - Adopter la promotion des propriétés du constructeur (`__construct(private readonly string $nom)`).
   - Ajouter `declare(strict_types=1);` en tête de fichier pour garantir la fiabilité des types.
3. **Frontend - Sécurisation et modernisation JavaScript** :
   - Remplacer l'injection `innerHTML` par `textContent` dans la génération des lignes de tableau (`genreTableBody`) pour supprimer le risque XSS.
   - Migrer les fonctions vers la syntaxe `async / await` en vérifiant `response.ok` avant de lire le JSON.

### 7.2 À SURVEILLER (Pertinent pour les étapes ultérieures)

1. **Tailwind CSS Standalone CLI (v4)** :
   - *Statut actuel* : Le CDN Play suffit amplement pour l'étape actuelle du prototype de développement.
   - *Déclencheur d'adoption* : Lorsque l'application préparera une mise en production ou nécessitera des styles personnalisés hors du périmètre par défaut, adopter le binaire autonome officiel sans ajouter Node.js au projet.
2. **Persistance SQLite intégrée (via PDO SQLite)** :
   - *Statut actuel* : `genres.json` répond parfaitement aux besoins du périmètre actuel.
   - *Déclencheur d'adoption* : Si le projet évolue vers la gestion complète des films avec relations complexes (clés étrangères entre films et genres, recherche plein texte, volumétrie importante), évaluer l'activation de SQLite natif (déjà inclus dans PHP).

### 7.3 À REJETER (Inadapté au contexte et contraire aux règles)

1. **Frameworks JavaScript (React, Vue, Angular, Svelte)** : Inutile pour une interface d'administration à formulaires simples ; alourdirait le projet et romprait l'architecture actuelle.
2. **Frameworks Backend complets (Laravel, Symfony)** : Disproportionné pour une API légère de gestion de ressources.
3. **Toolchains Node.js complexes (Webpack, Vite, npm scripts pour Vanilla JS)** : Complexité opérationnelle inutile violant la consigne de frugalité.
4. **Bases de données hébergées complexes (MySQL / PostgreSQL / Docker)** : Prématuré et inutile pour le prototype actuel.

---

## 8. Synthèse des actions recommandées pour les futurs sprints

```text
[Priorité 1 - Sécurité & Robustesse]
├── Sécurisation XSS : textContent dans genre.js
├── Verrouillage écriture : LOCK_EX dans Genre.php
└── Codes HTTP REST : http_response_code() et json_validate() dans genre-api.php

[Priorité 2 - Qualité du Code Natif]
├── Async/Await : refactorisation claire des appels API dans genre.js
└── PHP 8.x POO : constructeur promu et typage strict dans Genre.php

[Priorité 3 - Évolution à terme]
├── Tailwind CLI Standalone (si suppression du CDN Play requise)
└── Évaluation SQLite (uniquement si le modèle de données s'élargit aux films)
```
