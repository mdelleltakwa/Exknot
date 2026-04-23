# Exknot — Documentation Technique

---

## 1. Description du Projet

**Exknot** est une plateforme marketplace B2B développée avec **Laravel 11**, permettant à des **cabinets d'expertise** (firms) de publier leurs services professionnels et à des **clients entreprises** de les consulter, les commander et les évaluer.

### Concept
Le nom **"Exknot"** (Expert + Knot) symbolise le lien noué entre les entreprises clientes et les cabinets d'expertise. Le slogan **"Tie the right knot"** incarne la mission de la plateforme : connecter la bonne expertise au bon besoin.

### Fonctionnalités principales

| Module | Description |
|--------|-------------|
| **Authentification** | Inscription, connexion, vérification email, réinitialisation mot de passe (Laravel Breeze) |
| **Gestion des profils** | Nom, email, entreprise, pays, bio, avatar |
| **Catalogue de services** | Recherche, filtrage par catégorie, tri par prix/date, pagination |
| **Panier** | Ajout, modification quantité, suppression (stocké en session) |
| **Commandes** | Passage de commande, historique, statuts (pending → validated / cancelled) |
| **Avis & Notes** | Système de notation 1-5 étoiles + commentaire par service |
| **Messagerie** | Chat en temps réel entre clients et firms (polling AJAX) |
| **Administration** | Gestion des utilisateurs, changement de rôles, suppression de comptes |

### Rôles utilisateur

| Rôle | Permissions |
|------|-------------|
| **Client** | Consulter services, commander, laisser des avis, messagerie |
| **Firm** | Publier/modifier/supprimer des services, gérer les commandes reçues, messagerie |
| **Admin** | Accès total : gestion utilisateurs, changement de rôles, tableaux de bord globaux |

### Stack technique

- **Backend** : PHP 8.2+ / Laravel 11
- **Frontend** : Blade Templates / Tailwind CSS / Alpine.js
- **Base de données** : MySQL
- **Authentification** : Laravel Breeze
- **Build** : Vite
- **Serveur** : WAMP

---

## 2. Diagramme UML — Diagramme de Classes

```mermaid
classDiagram
    class User {
        +int id
        +string name
        +string email
        +datetime email_verified_at
        +string password
        +enum role ["client", "firm", "admin"]
        +string company_name
        +string country
        +text bio
        +string avatar
        +string remember_token
        +timestamps
        +isAdmin() bool
        +isFirm() bool
        +isClient() bool
        +products() HasMany
        +orders() HasMany
        +reviews() HasMany
        +conversations() Query
        +unreadMessagesCount() int
    }

    class Category {
        +int id
        +string name
        +string slug
        +text description
        +timestamps
        +products() HasMany
    }

    class Product {
        +int id
        +int user_id
        +int category_id
        +string title
        +text description
        +decimal price
        +string image
        +enum status ["active", "inactive"]
        +timestamps
        +user() BelongsTo
        +category() BelongsTo
        +reviews() HasMany
        +orderItems() HasMany
        +averageRating() float
    }

    class Order {
        +int id
        +int user_id
        +decimal total
        +enum status ["pending", "validated", "cancelled"]
        +text notes
        +timestamps
        +user() BelongsTo
        +items() HasMany
    }

    class OrderItem {
        +int id
        +int order_id
        +int product_id
        +int quantity
        +decimal price
        +timestamps
        +product() BelongsTo
        +order() BelongsTo
    }

    class Review {
        +int id
        +int user_id
        +int product_id
        +tinyint rating
        +text comment
        +timestamps
        +user() BelongsTo
        +product() BelongsTo
    }

    class Conversation {
        +int id
        +int client_id
        +int firm_id
        +timestamps
        +client() BelongsTo
        +firm() BelongsTo
        +messages() HasMany
        +latestMessage() HasOne
        +otherParty(User) User
        +unreadCountFor(int) int
        +findOrStart(int, int) Conversation
    }

    class Message {
        +int id
        +int conversation_id
        +int sender_id
        +text body
        +bool is_read
        +timestamps
        +conversation() BelongsTo
        +sender() BelongsTo
    }

    User "1" --> "*" Product : publishes
    User "1" --> "*" Order : places
    User "1" --> "*" Review : writes
    Category "1" --> "*" Product : contains
    Product "1" --> "*" Review : has
    Product "1" --> "*" OrderItem : included in
    Order "1" --> "*" OrderItem : contains
    User "1" --> "*" Conversation : as client
    User "1" --> "*" Conversation : as firm
    Conversation "1" --> "*" Message : has
    User "1" --> "*" Message : sends
```

---

## 3. Schéma de Base de Données

```mermaid
erDiagram
    users {
        bigint id PK
        varchar name
        varchar email UK
        timestamp email_verified_at
        varchar password
        enum role "client | firm | admin"
        varchar company_name
        varchar country
        text bio
        varchar avatar
        varchar remember_token
        timestamps created_at
        timestamps updated_at
    }

    categories {
        bigint id PK
        varchar name
        varchar slug UK
        text description
        timestamps created_at
        timestamps updated_at
    }

    products {
        bigint id PK
        bigint user_id FK
        bigint category_id FK
        varchar title
        text description
        decimal price "10,2"
        varchar image
        enum status "active | inactive"
        timestamps created_at
        timestamps updated_at
    }

    orders {
        bigint id PK
        bigint user_id FK
        decimal total "10,2"
        enum status "pending | validated | cancelled"
        text notes
        timestamps created_at
        timestamps updated_at
    }

    order_items {
        bigint id PK
        bigint order_id FK
        bigint product_id FK
        int quantity
        decimal price "10,2"
        timestamps created_at
        timestamps updated_at
    }

    reviews {
        bigint id PK
        bigint user_id FK
        bigint product_id FK
        tinyint rating "1-5"
        text comment
        timestamps created_at
        timestamps updated_at
    }

    conversations {
        bigint id PK
        bigint client_id FK
        bigint firm_id FK
        timestamps created_at
        timestamps updated_at
    }

    messages {
        bigint id PK
        bigint conversation_id FK
        bigint sender_id FK
        text body
        boolean is_read "default false"
        timestamps created_at
        timestamps updated_at
    }

    password_reset_tokens {
        varchar email PK
        varchar token
        timestamp created_at
    }

    sessions {
        varchar id PK
        bigint user_id FK
        varchar ip_address "45"
        text user_agent
        longtext payload
        int last_activity
    }

    users ||--o{ products : "publishes"
    users ||--o{ orders : "places"
    users ||--o{ reviews : "writes"
    categories ||--o{ products : "contains"
    products ||--o{ order_items : "included in"
    products ||--o{ reviews : "rated by"
    orders ||--o{ order_items : "contains"
    users ||--o{ conversations : "client_id"
    users ||--o{ conversations : "firm_id"
    conversations ||--o{ messages : "contains"
    users ||--o{ messages : "sender_id"
    users ||--o{ sessions : "has"
```

### Résumé des tables

| Table | Colonnes clés | Relations |
|-------|---------------|-----------|
| `users` | name, email, role, company_name, country, bio, avatar | → products, orders, reviews, conversations, messages |
| `categories` | name, slug, description | → products |
| `products` | title, description, price, image, status | → user, category, reviews, order_items |
| `orders` | total, status, notes | → user, order_items |
| `order_items` | quantity, price | → order, product |
| `reviews` | rating (1-5), comment | → user, product |
| `conversations` | client_id, firm_id (unique pair) | → client, firm, messages |
| `messages` | body, is_read | → conversation, sender |
| `password_reset_tokens` | email, token | — |
| `sessions` | payload, last_activity | → user |

### Contraintes notables
- `users.email` → unique
- `categories.slug` → unique
- `conversations(client_id, firm_id)` → unique composite
- `messages(conversation_id, created_at)` → index composite
- Toutes les clés étrangères ont `ON DELETE CASCADE`

---

## 4. Explication de l'Architecture

### Architecture MVC (Model-View-Controller)

L'application suit strictement le pattern **MVC** de Laravel :

```mermaid
flowchart TB
    subgraph CLIENT["🌐 Client (Navigateur)"]
        REQ["Requête HTTP"]
        RES["Réponse HTML"]
    end

    subgraph LARAVEL["⚙️ Laravel Application"]
        subgraph MIDDLEWARE["Middleware Layer"]
            AUTH["auth + verified"]
            ROLE["RoleMiddleware"]
        end

        subgraph ROUTES["Routes (web.php)"]
            PUB["Routes publiques"]
            PRIV["Routes authentifiées"]
            FIRM_R["Routes firm"]
            ADMIN_R["Routes admin"]
        end

        subgraph CONTROLLERS["Controllers"]
            PC["ProductController"]
            CC["CartController"]
            OC["OrderController"]
            RC["ReviewController"]
            DC["DashboardController"]
            CHC["ChatController"]
            PRC["ProfileController"]
            COC["ContactController"]
        end

        subgraph MODELS["Models (Eloquent ORM)"]
            UM["User"]
            PM["Product"]
            CM["Category"]
            OM["Order"]
            OIM["OrderItem"]
            RM["Review"]
            CONVM["Conversation"]
            MM["Message"]
        end

        subgraph VIEWS["Views (Blade Templates)"]
            LAY["layouts/app.blade.php"]
            WEL["welcome.blade.php"]
            SRV["services/*"]
            CRT["cart/*"]
            ORD["orders/*"]
            DSH["dashboard/*"]
            CHT["chat/*"]
            PRF["profile/*"]
        end
    end

    subgraph DB["🗄️ MySQL Database"]
        TABLES["8 tables principales"]
    end

    REQ --> MIDDLEWARE
    MIDDLEWARE --> ROUTES
    ROUTES --> CONTROLLERS
    CONTROLLERS --> MODELS
    MODELS --> DB
    CONTROLLERS --> VIEWS
    VIEWS --> RES
```

### Couche par couche

#### 1. Routes (`routes/web.php`)
Les routes sont organisées par **niveau d'accès** :

```
Routes publiques          → /, /services, /services/{id}, /privacy, /terms, /contact
Routes authentifiées      → /profile, /cart, /orders, /chat, /dashboard
Routes firm (firm,admin)  → /firm/dashboard, /firm/services/*, /firm/orders/*
Routes admin              → /admin/dashboard, /admin/users/*
```

#### 2. Middleware
| Middleware | Rôle |
|-----------|------|
| `auth` | Vérifie que l'utilisateur est connecté |
| `verified` | Vérifie que l'email est validé |
| `role:client,firm,admin` | Vérifie le rôle de l'utilisateur (accepte plusieurs rôles) |

#### 3. Controllers

| Controller | Responsabilité | Actions principales |
|-----------|---------------|---------------------|
| `ProductController` | Gestion des services (CRUD) | index, show, create, store, edit, update, destroy |
| `CartController` | Panier session | index, add, update, remove |
| `OrderController` | Commandes | index, show, store, cancel, updateStatus |
| `ReviewController` | Avis | store, destroy |
| `DashboardController` | 3 tableaux de bord | client(), firm(), admin() |
| `ChatController` | Messagerie | index, show, store, poll, start |
| `ProfileController` | Gestion profil | edit, update, destroy |
| `ContactController` | Formulaire contact | send |

#### 4. Models (Eloquent ORM)
Chaque model encapsule la logique métier et définit les relations :

- **User** : Modèle central avec 3 rôles, relations vers products, orders, reviews, conversations
- **Product** : Service publié par une firm, avec `averageRating()` calculé dynamiquement
- **Conversation** : Pattern de messagerie client↔firm avec `findOrStart()` (first-or-create)
- **Message** : Suivi de lecture avec `is_read` pour les notifications

#### 5. Views (Blade)
Organisation hiérarchique avec un **layout principal** (`layouts/app.blade.php`) et des sous-dossiers par fonctionnalité :

```
views/
├── layouts/app.blade.php       ← Layout principal (navbar, footer, Exknot branding)
├── welcome.blade.php           ← Landing page dynamique
├── dashboard.blade.php         ← Routeur de dashboard par rôle
├── dashboard/
│   ├── client.blade.php        ← Commandes récentes, avis, panier
│   ├── firm.blade.php          ← Services publiés, commandes reçues, revenus
│   └── admin.blade.php         ← Statistiques globales, gestion utilisateurs
├── services/
│   ├── index.blade.php         ← Catalogue avec recherche/filtres
│   ├── show.blade.php          ← Détail service + avis + bouton chat
│   ├── create.blade.php        ← Formulaire de création (firm)
│   └── edit.blade.php          ← Formulaire d'édition (firm)
├── cart/index.blade.php        ← Panier avec calcul total
├── orders/
│   ├── index.blade.php         ← Historique des commandes
│   └── show.blade.php          ← Détail d'une commande
├── chat/
│   ├── index.blade.php         ← Liste des conversations
│   └── show.blade.php          ← Thread de messagerie avec polling
├── profile/edit.blade.php      ← Édition du profil
└── pages/                      ← Pages statiques (privacy, terms, contact)
```

### Flux fonctionnels clés

#### Flux de commande
```mermaid
sequenceDiagram
    actor Client
    participant Catalogue
    participant Cart as Panier (Session)
    participant Order as OrderController
    participant DB as Base de données

    Client->>Catalogue: Parcourir les services
    Client->>Cart: Ajouter au panier
    Client->>Cart: Modifier quantités
    Client->>Order: Passer commande
    Order->>DB: Créer Order + OrderItems
    Order->>Cart: Vider le panier
    Order-->>Client: Confirmation commande

    Note over Client,DB: Le firm peut ensuite valider ou annuler
```

#### Flux de messagerie
```mermaid
sequenceDiagram
    actor Client
    actor Firm
    participant Chat as ChatController
    participant DB as Base de données

    Client->>Chat: Cliquer "Contacter" sur un service
    Chat->>DB: findOrStart(client_id, firm_id)
    Chat-->>Client: Afficher conversation

    Client->>Chat: Envoyer message
    Chat->>DB: Créer Message (is_read=false)

    loop Polling toutes les 3s
        Firm->>Chat: GET /chat/{id}/poll?after={lastId}
        Chat->>DB: Récupérer nouveaux messages
        Chat->>DB: Marquer comme lus
        Chat-->>Firm: JSON des nouveaux messages
    end
```

### Sécurité

| Mécanisme | Implémentation |
|-----------|---------------|
| **CSRF** | Protection automatique Laravel sur tous les formulaires POST/PATCH/DELETE |
| **XSS** | Échappement automatique Blade avec `{{ }}` |
| **SQL Injection** | Requêtes paramétrées via Eloquent ORM |
| **Autorisation** | Middleware `role:...` + vérifications `auth()->id()` dans les controllers |
| **Validation** | `$request->validate()` sur toutes les entrées utilisateur |
| **Upload** | Validation MIME type + taille max (2MB) pour les images |

---

### Identité visuelle

| Élément | Valeur |
|---------|--------|
| **Nom** | Exknot |
| **Slogan** | *Tie the right knot.* |
| **Couleur fond** | `#0A0D12` (dark) |
| **Couleur accent** | `#1D9E75` (teal) |
| **Couleur texte** | `#E8EDF2` |
| **Police** | DM Sans (Google Fonts) |
