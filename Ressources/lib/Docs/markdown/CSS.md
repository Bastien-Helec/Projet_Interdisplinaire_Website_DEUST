# CSS méthodes

---

```txt
Bastien Helec
Description : Explication de la méthode css

08-07-2025
```

## Sommaire

- [CSS méthodes](#css-méthodes)
  - [Sommaire](#sommaire)
    - [Model](#model)
    - [Vue-Implémentation](#vue-implémentation)

### Model

**Description** :

Il est indiqué qu'il n'existe qu'un seul fichier pour la partie CSS du modèle, nommé `Args_CSS.php`.

PATH : `Model/CSS/PAGES`

**Classe Args_CSS** :

Cette classe sert à générer dynamiquement du code CSS à partir de PHP.

Elle permet de définir un identifiant ou une classe CSS, puis d'y associer des propriétés et valeurs CSS.

**Arguments du constructeur**:

`$class_id` : Chaîne de caractères (String) représentant l'identifiant ou la classe CSS à cibler (exemple : #monId ou .maClasse).

`$global_regles` : Tableau associatif optionnel contenant des paires propriété/valeur CSS à appliquer dès la création de l'objet.

Exemple d'utilisation :

```php
<?php
$css = new Args_CSS('.maClasse');
$css->set('font-size', '16px');
echo $css->gen_css();
php>
```

Cela produira :

```css
.maClasse {
font-size:16px;
}
```

Méthodes principales

`set($prop, $value)` : Ajoute ou modifie une propriété CSS pour la classe/ID ciblé.

`gen_css()` : Génère le code CSS complet sous forme de chaîne de caractères, prêt à être inséré dans une page HTML.

---

### Vue-Implémentation

Il n'y a pas de section vue afin de pouvoir l'utiliser il faut alors créer un Controller_CSS contenant :

```php
header("Content-Type: text/css");
```

Ce paramètre permet d'indiquer au serveur PHP l'utilisation de ce controller comme un CSS.

Le serveur considérera ce fichier comme une feuille `style.css`.
