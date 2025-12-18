# Mode d'emploi
1. Télécharger/Clone le dépôt GitHub
2. Placer les fichiers à la racine d'un serveur web (local ou non)
3. Posséder un GBD et y importer la base de donnée disponible le dossier "Ressources" à la racine du projet
4. Se connecter à "http://votre.host/index.php" dans un navigateur
---
5. Depuis l'accueil, cliquer sur "Commencer à jouer" pour choisir une liste aléatoire, cliquez sur une des liste disponible dans la catégorie "Listes disponible" de la page d'accueil ou sur "Créer une liste" pour créer votre propre liste.

# Technologies utilisées
### 1. HTML5    
Utilisé pour structurer les pages d'accueil et de jeu ainsi que pour la mise en page générale du contenu.

### 2. CSS3    
Utilisé pour le style, la mise en page et les animations.
Principales fonctionnalités CSS utilisées :
- Flexbox pour l’organisation des éléments
- Grille CSS (Grid) pour l’affichage des listes populaires
- Animations CSS (@keyframes) pour les effets Smash/Pass et l’apparition des cartes
- Transitions pour adoucir les interactions

### 3. JavaScript ES25
Rôle :
- Gérer la logique Smash/Pass
- Changer le personnage affiché
- Mettre à jour le compteur de progression
- Déclencher les animations CSS via l’ajout/suppression de classes
- Empêcher les double-clics pendant une animation

# Navigateurs
Testé sur :
- Google Chrome (version 142.0.7444.163)
- Mozilla Firefox (version 93.0)
- Microsoft Edge (version  142.0.3595.94)

# Structure du dépôt
Voici la structure recommandée :
```bash
/ (racine du projet)
│── index.html                               → Page d’accueil
└── /Assets        
      │── /Images
      │     └── /Listes                      → Dossier on sont stocker les images des listes (1 sous dossier par liste)
      │── /Pages
      │     │── creationListe.html           → page de création des listes personnalisées
      │     └── game.html                    → page de jeu
      │── /Scripts
      │     │── /CreationListes
      │     │     │── creationListes.js      → Logique de la page de création des listes
      │     │     └── creationListes.php     → Interface client/serveur (JS/PHP)
      │     └── /Game
      │           │── retrieveOpponents.php  → Interface client/serveur (JS/PHP)
      │           └── script.js              → Logique de la page de jeu
      └── /Styles            
            └── style.css
```

# Dépendances
Notre projet ne nécessite aucune dépendance externe.
