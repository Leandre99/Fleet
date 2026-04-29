# 🚗 Fleet Premium - Plateforme de Transport de Luxe

Fleet Premium est une application web de gestion de flotte et de réservation de véhicules avec chauffeur (VTC), conçue pour offrir une expérience utilisateur haut de gamme (similaire à Uber, Yango ou Gozem).

Le projet est construit avec **Laravel 12** et **Bootstrap 5**, mettant l'accent sur une esthétique moderne et une logique métier complète.

---

## 🌟 Fonctionnalités Clés

### 📱 Interfaces Utilisateurs
- **Landing Page Premium** : Design moderne avec animations fluides (AOS) et formulaire de réservation rapide.
- **Espace Client** : 
  - Réservation de courses avec estimation de prix basée sur la distance.
  - **Suivi en temps réel** : Page de tracking dynamique avec mise à jour automatique (Polling) et animation du trajet sur carte Leaflet.js.
  - **Notation & Feedback** : Possibilité de noter le chauffeur et de laisser un commentaire après chaque course.
  - **Choix du Paiement** : Sélection entre paiement par Carte (simulé) ou en Espèces.
- **Espace Chauffeur** :
  - Dashboard pour voir les courses disponibles à proximité.
  - **Validation de Paiement** : Pour les paiements en espèces, le chauffeur doit confirmer la réception manuellement pour clôturer la course.
  - **Statistiques de Gains** : Suivi en temps réel du nombre de courses effectuées et du total des gains perçus.
- **Dashboard Admin Dédié** : 
  - Monitoring global de l'activité.
  - **Gestion des Utilisateurs** : Activation/Désactivation des comptes clients et chauffeurs.
  - **Approbation des Chauffeurs** : Validation manuelle des nouveaux chauffeurs avant qu'ils ne puissent exercer.
  - **Détails des Courses** : Vue détaillée de chaque trajet avec carte interactive.

### ⚙️ Logique Métier
- **Système de Rôles** : Gestion robuste des permissions (Clients, Chauffeurs, Admins).
- **Cycle de Course Complet** : Demande -> Acceptation -> Trajet -> Paiement -> Confirmation -> Notation.
- **Calcul de Tarif** : Algorithme d'estimation dynamique.

---

## 🛠️ Stack Technique
- **Backend** : Laravel 12 (PHP)
- **Frontend** : Blade Templates, Bootstrap 5, AOS.js (Animations)
- **Cartographie** : Leaflet.js (OpenStreetMap)
- **Authentification** : Laravel Breeze (Customisé)
- **Base de données** : SQLite / MySQL (Eloquent ORM)

---

## 🚀 Guide de Démarrage Rapide

### 1. Installation
```bash
git clone https://github.com/Leandre99/Fleet.git
cd Fleet
composer install
npm install && npm run build
```

### 2. Configuration
- Créez votre base de données.
- Configurez votre fichier `.env` :
  ```bash
  cp .env.example .env
  php artisan key:generate
  ```

### 3. Base de données & Données de test
```bash
php artisan migrate:fresh --seed --class=UserRoleSeeder
```

### 4. Lancement
```bash
php artisan serve
```

---

## 🔑 Identifiants de Connexion (Démos)
Mot de passe par défaut : `password`

| Rôle | Email |
| :--- | :--- |
| **Admin** | `admin@fleet.com` |
| **Chauffeur** | `driver@fleet.com` |
| **Client** | `client@fleet.com` |

---

Développé par **Léandre ELISHA** et **TONATO Prince** avec passion.
