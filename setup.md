# Mise en place : 

## Pour le premier developpeur qui initialise le projet

Un des développeurs va commencer par faire la commande

```npm init```

Cela va initialiser le projet et créer le fichier package.json qui contient des métadonnées descriptives et fonctionnelles sur un projet, telles que le nom, la version et les dépendances.

ensuite le développeur va installer les dépendances nécessaires voici les commandes :

```npm install  sass```


## Pour les développeurs une fois le projet initialisé

Les autres développeurs devront cloner le projet puis faire la commande :

```npm install```

cela installera toute les dépendances nécessaires au projet ou les mettra à jour si ce n’est pas le cas

# Utilisation de SASS :

Le scss etant un langage qui n’est pas reconnu par les navigateurs, il faut le compiler en css. Pour cela nous avons utilisé le module node-sass qui permet de compiler le scss en css. Pour l’utiliser il faut faire la commande :

```bash 
sass --watch FestiplanWeb/static/style/scss:FestiplanWeb/static/style/css
```

Cela permet de compiler le scss en css et de mettre à jour le fichier css à chaque modification du fichier scss. 
Il faut donc laisser cette commande tourner en arrière plan pendant toute la durée du développement et lier le fichier css compilé au fichier html.
Essayez de ne pas modifier le fichier css directement car il sera écrasé à chaque compilation du scss.

#### si vous utilisez un IDE de jetbrains, vous pouvez configurer un watcher pour le scss, cela permet de ne pas avoir à lancer la commande en arrière plan.

*demandez a quentin pour la configuration du watcher*

# Utilisation de jQuery :

```<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>```

Jquery est une bibliothèque JavaScript qui permet de manipuler le DOM. Elle permet de manipuler le DOM de manière plus simple et plus rapide que le JavaScript. 
L'une des principales caractéristiques de jQuery est sa capacité à sélectionner des éléments du DOM à l'aide de sélecteurs CSS.

exemple : 

```$ ("#id")```

```$ (".class")```

```$ ("balise")```

Cela permet de sélectionner un élément du DOM et de pouvoir le manipuler.

# Utilisation de GSAP :

```<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>```

GSAP est une bibliothèque JavaScript qui permet de créer des animations. Elle permet de créer des animations de manière plus simple et plus rapide que le JavaScript.
GSAP permet de créer des animations sur les propriétés CSS, les objets JavaScript, les propriétés DOM et les attributs SVG.

exemple : 

```$ gsap.to(".class", {duration: 1, x: 100, y: 100});```

Cela permet de créer une animation qui va déplacer l’élément de la classe class de 100px en x et 100px en y en 1 seconde.
