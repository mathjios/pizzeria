# 🍕 Pizzeria – Application Web

Bienvenue sur mon projet de **site web de pizzeria**.

Cette application permet aux utilisateurs de consulter les pizzas disponibles, créer un compte, passer une commande et gérer leurs informations.

Un espace administrateur permet également de gérer les pizzas proposées par la pizzeria.

---

## 🎯 Objectif du projet

L'objectif de ce projet est de créer une application web complète permettant de gérer une pizzeria en ligne.

L'application permet notamment :

- 🍕 Consulter les pizzas
- 👤 Créer un compte
- 🔐 Se connecter
- 🛒 Ajouter des pizzas au panier
- ➕ Modifier les quantités
- ➖ Supprimer des articles
- ❌ Annuler une commande
- 💳 Consulter le total de la commande
- 🏠 Enregistrer plusieurs adresses de livraison
- 📦 Passer une commande
- 📜 Consulter l'historique des commandes
- 👨‍💼 Gérer les pizzas avec un compte administrateur

---

# 🛠️ Technologies utilisées

## 💻 Développement

- HTML5
- CSS3
- JavaScript
- PHP

## 🗄️ Base de données

- MySQL
- SQL
- phpMyAdmin

## 🔧 Environnement

- XAMPP
- Apache
- Visual Studio Code
- Git
- GitHub

---

# 🍕 Fonctionnalités

## 👤 Gestion des utilisateurs

Les visiteurs peuvent créer un compte afin d'utiliser les fonctionnalités de commande.

Les informations enregistrées peuvent comprendre :

- Nom d'utilisateur
- Adresse e-mail
- Mot de passe
- Numéro de téléphone
- Adresse

---

## 🔐 Connexion

L'application dispose d'un système d'authentification permettant aux utilisateurs de :

- Créer un compte
- Se connecter
- Se déconnecter
- Accéder à leur espace utilisateur

Les sessions PHP sont utilisées pour conserver les informations de connexion.

---

# 👨‍💼 Gestion des rôles

L'application distingue deux types d'utilisateurs :

### 👤 Client

Le client peut :

- Consulter les pizzas
- Ajouter des pizzas au panier
- Modifier son panier
- Passer une commande
- Gérer ses adresses
- Consulter son historique

### 👨‍💼 Administrateur

L'administrateur possède des fonctionnalités supplémentaires.

Il peut notamment :

- Ajouter une pizza
- Modifier les informations d'une pizza
- Gérer les pizzas disponibles
- Ajouter une image
- Définir le prix
- Définir les ingrédients

---

# 🍕 Gestion des pizzas

Chaque pizza peut contenir plusieurs informations :

```text
Nom
Prix
Ingrédients
Image
