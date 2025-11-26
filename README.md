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

Comme il s'agit d'un site statique, aucune installation de serveur n'est requise.

# Structure du dépôt
Voici la structure recommandée :
```bash
/ (racine du projet)
│── index.html          → Page d’accueil
│── game.html           → Page de jeu (Smash/Pass)
│── style.css           → Styles et animations
│── script.js           → Logique Smash/Pass
│
└── /img                → Dossier contenant les images
      ├── Mario.jpg
      ├── Pikachu.jpg
      └── Pringles.jpg
```

# Mode d'emploi
1. Télécharger le dépôt GitHub
2. Extraire le dossier
3. Ouvrir index.html dans un navigateur
4. Depuis l'accueil, cliquer sur "Commencer à jouer" ou ouvrir game.html pour tester la mécanique Smash/Pass.

Site accessible au : https://mlavigne2.github.io/8WEB101_Equipe15/

# Dépendances
Notre projet ne nécessite aucune dépendance externe.
