# Acala Backend — Laravel API

Backend API untuk **Acala Bar & Bistro** website, dibangun dengan **Laravel 12**.

## Stack
- **PHP 8.2+** / Laravel 12
- **SQLite** (dev) / MySQL/PostgreSQL (production)
- **Laravel Sanctum** — session-based API authentication
- **Google Analytics API** — analytics data

## Struktur Folder

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── CmsAuthController.php      ← Login, logout, me
│   │   ├── CmsContentController.php   ← CRUD content blocks
│   │   ├── CmsDatasetController.php   ← CRUD datasets (menu, branches)
│   │   ├── CmsImageController.php     ← Image library management
│   │   ├── CmsMediaController.php     ← File upload ke storage
│   │   └── Api/
│   │       └── CmsAnalyticsController.php ← Google Analytics data
│   └── Middleware/
│       └── SecurityHeaders.php        ← Security HTTP headers
├── Models/
│   ├── CmsContent.php                 ← Content blocks
│   ├── CmsDataset.php                 ← Dataset (menu, branches, dll)
│   ├── CmsImage.php                   ← Image library
│   └── User.php                       ← Admin users
└── Services/
    └── GoogleAnalyticsService.php     ← Google Analytics & Search Console
routes/
├── api.php     ← Semua CMS API endpoints (prefix: /api)
└── web.php     ← Health check saja
```

## API Endpoints

| Method | URL | Auth | Keterangan |
|--------|-----|------|-----------|
| `POST` | `/api/cms/login` | — | Login admin |
| `POST` | `/api/cms/logout` | — | Logout |
| `GET` | `/api/cms/me` | — | Cek session |
| `GET` | `/api/cms/public/{page}` | — | Konten publik per halaman |
| `GET` | `/api/cms/public-datasets` | — | Semua dataset publik |
| `GET` | `/api/cms/public-datasets/{key}` | — | Dataset spesifik |
| `GET` | `/api/cms/public-images` | — | Gambar publik |
| `GET` | `/api/cms/contents` | ✅ Admin | List content blocks |
| `POST` | `/api/cms/contents` | ✅ Admin | Buat content |
| `PUT` | `/api/cms/contents/{id}` | ✅ Admin | Update content |
| `DELETE` | `/api/cms/contents/{id}` | ✅ Admin | Hapus content |
| `GET` | `/api/cms/datasets` | ✅ Admin | List datasets |
| `POST` | `/api/cms/datasets` | ✅ Admin | Buat dataset |
| `PUT` | `/api/cms/datasets/{id}` | ✅ Admin | Update dataset |
| `DELETE` | `/api/cms/datasets/{id}` | ✅ Admin | Hapus dataset |
| `POST` | `/api/cms/media/upload` | ✅ Admin | Upload file |
| `GET` | `/api/cms/images` | ✅ Admin | List gambar |
| `PUT` | `/api/cms/images/{key}` | ✅ Admin | Update gambar |
| `GET` | `/api/cms/analytics` | ✅ Admin | Analytics data |
| `GET` | `/health` | — | Health check |

## Setup

```bash
# Clone dan masuk ke folder
cd acala-backend

# Install dependencies
composer install

# Copy dan isi .env
cp .env.example .env
php artisan key:generate

# Buat database dan migrate
touch database/database.sqlite
php artisan migrate

# Buat admin user
php artisan tinker
# >>> App\Models\User::create(['name'=>'Admin','email'=>'admin@acala.com','password'=>bcrypt('password')])

# Jalankan server
php artisan serve
# → http://localhost:8000
```

## CORS Configuration

Edit `.env`:
```
CORS_ALLOWED_ORIGINS="http://localhost:5173,https://acala.yourdomain.com"
SANCTUM_STATEFUL_DOMAINS="localhost:5173,acala.yourdomain.com"
```

Edit `config/cors.php` untuk konfigurasi lebih lanjut.

## Environment Variables

| Variable | Keterangan |
|----------|-----------|
| `APP_URL` | URL backend (default: `http://localhost:8000`) |
| `CORS_ALLOWED_ORIGINS` | Domain frontend yang diizinkan |
| `SANCTUM_STATEFUL_DOMAINS` | Domain untuk session-based auth |
| `GOOGLE_APPLICATION_CREDENTIALS` | Path ke service account JSON |
| `GA4_PROPERTY_ID` | Google Analytics 4 Property ID |
| `GSC_SITE_URL` | Google Search Console site URL |
