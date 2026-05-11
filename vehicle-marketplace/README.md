# Vehicle Marketplace - KINETIC

Hệ thống thương mại điện tử xe cao cấp được xây dựng với Laravel 13, PostgreSQL, và nhiều tính năng hiện đại.

## Technologies

- **Backend:** Laravel 13 (PHP 8.3)
- **Database:** PostgreSQL (Render Managed Database)
- **Frontend:** Tailwind CSS 4, Vite
- **Authentication:** Laravel's built-in auth
- **Authorization:** Spatie Laravel Permission
- **File Upload:** Spatie Laravel Medialibrary
- **Deployment:** Render.com (Web Service + PostgreSQL Database)

## Local Development

### Prerequisites
- PHP 8.3+
- Composer
- Node.js 18+
- SQLite (local) or PostgreSQL

### Installation

```bash
# Clone repo
git clone <your-repo-url>
cd vehicle-marketplace

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database (local uses SQLite)
touch database/database.sqlite
php artisan migrate --seed

# Build frontend
npm run build

# Run server
php artisan serve
```

### Default Accounts
- **Admin:** admin@kinetic.com / 123456
- **User:** user@kinetic.com / 123456

---

## Deploy lên Render.com

### Bước 1: Chuẩn bị Git Repository

```bash
cd vehicle-marketplace
git init
git add .
git commit -m "Initial commit"
# Tạo repo trên GitHub/GitLab rồi push
git remote add origin <your-repo-url>
git push -u origin main
```

### Bước 2: Tạo PostgreSQL Database trên Render

1. Đăng nhập [Render Dashboard](https://dashboard.render.com)
2. Click **New** → **PostgreSQL**
3. Cấu hình:
   - **Name:** `vehicle-marketplace-db`
   - **Database:** `vehicle_marketplace`
   - **Plan:** Free
4. Click **Create Database**
5. **Copy External Database URL** - bạn sẽ cần nó ở bước sau

> **URL Format:** `postgresql://user:password@host:5432/database_name`

### Bước 3: Tạo Web Service trên Render

1. Click **New** → **Web Service**
2. Connect GitHub repo của bạn
3. Cấu hình:

| Field | Value |
|-------|-------|
| **Name** | `vehicle-marketplace` |
| **Runtime** | `PHP` |
| **Build Command** | `composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-exif && npm install && npm run build && php artisan storage:link --force` |
| **Start Command** | `php artisan serve --host=0.0.0.0 --port=$PORT` |
| **Plan** | Free |

### Bước 4: Cấu hình Environment Variables

Trong tab **Environment** của Web Service, thêm các biến:

```env
APP_NAME=KINETIC
APP_ENV=production
APP_DEBUG=false
APP_KEY=                    # Để trống, Render sẽ tự generate
APP_URL=https://vehicle-marketplace.onrender.com

APP_LOCALE=vi
APP_FALLBACK_LOCALE=en

DB_CONNECTION=pgsql
DATABASE_URL=               # Paste External Database URL từ bước 2
# HOẶC điền riêng:
# DB_HOST=...
# DB_PORT=5432
# DB_DATABASE=vehicle_marketplace
# DB_USERNAME=...
# DB_PASSWORD=...

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=error
MAIL_MAILER=log
```

> **Lưu ý:** Render sẽ tự động set `APP_KEY` khi deploy lần đầu. Nếu không, thêm thủ công:
> ```bash
> php artisan key:generate
> ```

### Bước 5: Persistent Disk (cho uploads ảnh)

Nếu muốn uploads ảnh tồn tại lâu dài:

1. Trong Web Service → **Settings**
2. Thêm **Disk**:
   - **Name:** `storage`
   - **Mount Path:** `/opt/render/project/storage`
   - **Size:** 1 GB

3. Cập nhật `config/filesystems.php`:
```php
'local' => [
    'driver' => 'local',
    'root' => storage_path('app/private'),
    'serve' => true,
    'throw' => false,
],

'public' => [
    'driver' => 'local',
    'root' => env('RENDER_DISK_MOUNT_PATH', storage_path('app/public')),
    'url' => env('APP_URL') . '/storage',
    'visibility' => 'public',
    'throw' => false,
],
```

### Bước 6: Deploy

1. Render sẽ tự động deploy khi bạn push code lên GitHub
2. Hoặc click **Manual Deploy** → **Deploy latest commit**
3. Đợi build hoàn thành (~3-5 phút)
4. Truy cập URL: `https://your-app-name.onrender.com`

### Bước 7: Khởi tạo Database

Sau khi deploy lần đầu, chạy migration + seed:

```bash
# Vào Web Service → Shell (hoặc dùng Render CLI)
php artisan migrate:fresh --seed --force
```

Hoặc thêm vào **Build Command**:
```
composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-exif && npm install && npm run build && php artisan storage:link --force && php artisan migrate --force && php artisan db:seed --force
```

---

## Database Schema

### PostgreSQL Tables

**categories**
- `id` (bigserial PK)
- `name` (varchar 256)
- `created_at`, `updated_at`

**products**
- `id` (bigserial PK)
- `name` (varchar 256)
- `slug` (varchar 256, unique)
- `description` (varchar 1024, nullable)
- `image` (varchar 2048, nullable)
- `price` (double precision)
- `quantity` (integer)
- `view` (integer)
- `category_id` (FK → categories, cascade delete)
- `created_at`, `updated_at`

**users**
- `id` (bigserial PK)
- `email` (varchar 45, unique)
- `password` (varchar 255)
- `role` (varchar 45, default 'user')
- `remember_token`
- `created_at`, `updated_at`

**orders**
- `id` (bigserial PK)
- `code` (varchar 45)
- `status` (varchar 45, default 'pending')
- `customer_name` (varchar 255)
- `phone` (varchar 20)
- `email` (varchar 255)
- `address` (varchar 500)
- `payment_method` (varchar 50, default 'cod')
- `note` (text, nullable)
- `user_id` (FK → users, cascade delete)
- `created_at`, `updated_at`

**order_details**
- `id` (bigserial PK)
- `product_id` (FK → products, cascade delete)
- `order_id` (FK → orders, cascade delete)
- `quantity` (integer)
- `price` (double precision)
- `created_at`, `updated_at`

**Spatie Permission Tables:**
- `roles`, `permissions`, `model_has_roles`, `model_has_permissions`, `role_has_permissions`

**Spatie Media Library:**
- `media`

**System Tables:**
- `cache`, `cache_locks`, `jobs`, `job_batches`, `failed_jobs`, `sessions`

---

## Troubleshooting

### Build thất bại trên Render
- Kiểm tra PHP version compatibility
- Đảm bảo `composer.json` có `--ignore-platform-req=ext-exif` trong build command

### Database connection refused
- Kiểm tra `DATABASE_URL` environment variable
- Đảm bảo PostgreSQL service đã tạo và đang chạy

### Storage link không hoạt động
- Chạy `php artisan storage:link --force` trong build command
- Nếu dùng Persistent Disk, đảm bảo mount path đúng

### APP_KEY missing
- Thêm `APP_KEY=base64:...` vào env vars
- Hoặc chạy `php artisan key:generate` trong shell
