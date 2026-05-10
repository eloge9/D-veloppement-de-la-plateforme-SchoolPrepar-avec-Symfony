# 🌍 Vitrine - SchoolPrepar

## 📁 Organisation des templates

### 🏗️ Structure des dossiers

```
templates/vitrine/
├── base.html.twig     # Layout principal
├── pages/             # Pages principales
│   ├── home.html.twig
│   ├── filieres.html.twig
│   ├── filiere_show.html.twig
│   ├── etablissements.html.twig
│   └── etablissement_show.html.twig
├── partials/          # Composants réutilisables
│   ├── header.html.twig
│   ├── nav.html.twig
│   ├── footer.html.twig
│   ├── hero.html.twig
│   └── section-header.html.twig
└── README.md          # Documentation
```

### 🎯 Règles de la vitrine

- **PUBLIC** : Accessible uniquement aux utilisateurs NON CONNECTÉS
- **REDIRECTION** : Si connecté → redirection automatique vers dashboard
- **NAVIGATION** : Boutons Connexion/Inscription uniquement
- **AUCUN LIEN** vers les dashboards internes

### 🧩 Composants disponibles

#### `base.html.twig`
Layout principal avec :
- Header organisé
- Footer
- Scripts et styles

#### `partials/header.html.twig`
En-tête complet avec :
- Logo SchoolPrepar
- Navigation principale
- Boutons Connexion/Inscription

#### `partials/hero.html.twig`
Section hero pour page d'accueil

#### `partials/section-header.html.twig`
En-tête de section paramétrable :
- `title` : Titre de la section
- `subtitle` : Sous-titre optionnel

### 📝 Utilisation

```twig
{% extends 'vitrine/base.html.twig' %}

{% block title %}Page Title - SchoolPrepar{% endblock %}

{% block content %}
{% include 'vitrine/partials/section-header.html.twig' with {
    'title': 'Nos Filieres',
    'subtitle': 'Découvrez nos formations'
} %}

<!-- Contenu de la page -->
{% endblock %}
```

### 🔧 Routes associées

- `app_vitrine_home` → `/`
- `app_vitrine_filieres` → `/filieres`
- `app_vitrine_filiere_show` → `/filieres/{id}`
- `app_vitrine_etablissements` → `/etablissements`
- `app_vitrine_etablissement_show` → `/etablissements/{id}`

### ⚠️ Important

Cette vitrine est **totalement indépendante** du système interne. Les utilisateurs connectés sont automatiquement redirigés vers leurs dashboards respectifs.
