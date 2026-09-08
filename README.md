# evolusi-pl-542240

Tugas 1 mata kuliah Evolusi dan Konstruksi Perangkat Lunak (EKPL). Aplikasi web sederhana dibangun dengan Laravel, dipakai sebagai bahan latihan branching (`main` -> `dev` -> `feature/*`), pull request, dan CI dengan GitHub Actions.

## Menjalankan secara lokal

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

## Menjalankan test

```bash
php artisan test
```

## Alur kerja branch

- `main` - kode stabil, hanya menerima merge dari `dev` lewat pull request.
- `dev` - branch integrasi, menerima merge dari `feature/*` lewat pull request.
- `feature/*` - branch kerja untuk satu perubahan.
