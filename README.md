# 🚗 Fleet Premium - Plateforme de Transport de Luxe

Fleet Premium est une application web de gestion de flotte et de réservation de véhicules avec chauffeur (VTC), conçue pour offrir une expérience utilisateur haut de gamme (similaire à Uber, Yango ou Gozem).

Le projet est construit avec **Laravel 12** et **Bootstrap 5**, mettant l'accent sur une esthétique moderne et une logique métier complète.

---

## 🌟 Ce que contient le projet

### 📱 Interfaces Utilisateurs
- **Landing Page Premium** : Design soigné en blanc et vert, animations fluides (AOS), et formulaire de réservation rapide.
- **Espace Client** : 
  - Réservation de courses avec estimation de prix.
  - **Suivi en temps réel** : Page de tracking dynamique avec mise à jour automatique (Polling) et animation du trajet sur carte Leaflet.js.
  - Historique complet des courses.
- **Espace Chauffeur** :
  - Dashboard pour voir les courses "En attente" à proximité.
  - Système d'acceptation et de gestion du cycle de vie de la course (Départ -> En cours -> Terminé).
- **Dashboard Admin Dédié** : 
  - Layout unique avec **Sidebar verticale**.
  - Monitoring global de l'activité et statistiques de revenus.

### ⚙️ Logique Métier
- **Système de Rôles** : Gestion distincte des permissions pour Clients, Chauffeurs et Admins.
- **Cycle de Course Uber-like** : Demande -> Attente -> Acceptation Chauffeur -> Trajet -> Finalisation.
- **Simulation Temps Réel** : Mise à jour automatique de l'interface client dès qu'un chauffeur accepte la course (via Polling JS).
- **Calcul de Tarif** : Algorithme d'estimation basé sur la distance simulée.

---

## 🛠️ Stack Technique
- **Backend** : Laravel 12 (PHP)
- **Frontend** : Blade Templates, Bootstrap 5, AOS.js (Animations)
- **Maps** : Leaflet.js (OpenStreetMap)
- **Auth** : Laravel Breeze (Personnalisé en Bootstrap)
- **Base de données** : MySQL / SQLite (Eloquent ORM)

---

## 🚀 Guide de Démarrage Rapide

### 1. Installation
```bash
# Cloner le dépôt
git clone https://github.com/Leandre99/Fleet.git
cd Fleet

# Installer les dépendances PHP
composer install

# Installer les dépendances Node (optionnel pour la prod)
npm install && npm run build
```

### 2. Configuration
- Créez votre base de données.
- Copiez le fichier `.env.example` en `.env` :
  ```bash
  cp .env.example .env
  ```
- Générez la clé d'application :
  ```bash
  php artisan key:generate
  ```

### 3. Base de données & Données de test
Lancez les migrations et le seeder pour créer les rôles et les comptes de démonstration :
```bash
php artisan migrate:fresh --seed --class=UserRoleSeeder
```

### 4. Lancement
```bash
php artisan serve
```
Le site sera accessible sur `http://127.0.0.1:8000`.

---

## 🔑 Identifiants de Connexion (Démos)
Tous les comptes utilisent le mot de passe : `password`

| Rôle | Email | Description |
| :--- | :--- | :--- |
| **Administrateur** | `admin@fleet.com` | Accès à la gestion globale et sidebar. |
| **Chauffeur** | `driver@fleet.com` | Accès aux courses à accepter. |
| **Client** | `client@fleet.com` | Accès à la réservation et au suivi. |

---

## 📸 Aperçus Visuels
- **Hero Section** : Image HD d'une Mercedes S-Class à Dubaï.
- **Tracking** : Animation d'un marqueur véhicule sur une carte dynamique.
- **Admin** : Interface sombre et épurée pour la gestion.

---
Développé par **Leandre99** avec passion pour l'excellence opérationnelle.
