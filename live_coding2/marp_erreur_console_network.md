---
marp: true
theme: default
paginate: true
---

# Erreur `Unexpected token '<'`

## 1. Erreur affichée dans la console

```text
SyntaxError: Unexpected token '<'
```

**Signification :** JavaScript attend du JSON, mais reçoit du HTML.

---

## 2. Où est le vrai problème ?

Dans **Network → Api_genres.php → Response**, on trouve l'erreur PHP :

```text
Warning: Undefined array key "nom"
```

**Cause :** JavaScript envoie `nome`, alors que PHP cherche `nom`.

---

## 3. Pourquoi d'autres erreurs apparaissent ?

- `Undefined array key "nom"` : la clé est introuvable.
- `null given` : PHP ne récupère pas de valeur.
- `TypeError` : le constructeur attend une `string`, mais reçoit `null`.
- `Unexpected token '<'` : JavaScript reçoit le HTML de l'erreur au lieu du JSON.

---

## 4. Correction

Utiliser le même nom de clé dans JavaScript et PHP :

```js
const data = {
    nom: nomInput.value,
    description: descriptionInput.value
};
```

```php
$data["nom"]
```

**À retenir :** la console montre l'échec JSON ; la réponse dans Network permet de trouver l'erreur PHP d'origine.
