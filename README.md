# Fleet Premium - Plateforme de Gestion de Flotte de Luxe

Fleet Premium est une application web moderne inspirée de solutions comme Uber, Yango ou Gozem. Elle permet la mise en relation de clients avec des chauffeurs professionnels pour des trajets de luxe dans les grandes métropoles (Paris, Londres, Dubaï).

## 🚀 Fonctionnalités

### Pour les Clients
- **Réservation en temps réel** : Estimation du prix et de la distance instantanée.
- **Suivi de course** : Carte interactive avec animation du trajet et mises à jour de statut automatiques.
- **Historique des courses** : Consultation de tous les trajets passés.
- **Gestion du profil** : Modification des informations personnelles.

### Pour les Chauffeurs
- **Tableau de bord dédié** : Visualisation des courses en attente à proximité.
- **Gestion du cycle de vie** : Acceptation, démarrage et finalisation des trajets.
- **Statistiques** : Suivi des gains et de l'activité quotidienne.

### Pour l'Administrateur
- **Dashboard avec Sidebar** : Interface de gestion complète et isolée.
- **Statistiques globales** : Revenus totaux, volume de courses, nombre de chauffeurs.
- **Monitoring** : Surveillance de l'activité sur la plateforme.

## 🛠️ Stack Technique
- **Framework** : Laravel 12 (PHP)
- **Frontend** : Blade Templates + Bootstrap 5
- **Design** : Charte graphique Premium (Blanc & Vert), AOS.js (Animations)
- **Interactivité** : Leaflet.js (Cartographie), Polling JS (Mise à jour en temps réel)
- **Authentification** : Laravel Breeze

## 🔑 Comptes de Démo (Mot de passe: `password`)
- **Admin** : `admin@fleet.com`
- **Chauffeur** : `driver@fleet.com`
- **Client** : `client@fleet.com`

## 📦 Installation

1. Cloner le projet :
   ```bash
   git clone https://github.com/Leandre99/Fleet.git
   ```
2. Installer les dépendances PHP :
   ```bash
   composer install
   ```
3. Configurer le fichier `.env` (Base de données).
4. Lancer les migrations et le seeder :
   ```bash
   php artisan migrate:fresh --seed --class=UserRoleSeeder
   ```
5. Lancer le serveur :
   ```bash
   php artisan serve
   ```

---
Développé avec passion pour **Fleet Premium**.
