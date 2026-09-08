# evolusi-pl-542240

Tugas 1 mata kuliah Evolusi dan Konstruksi Perangkat Lunak. Aplikasi to-do list sederhana dibangun dengan Laravel, dipakai sebagai bahan latihan branching (`main` → `dev` → `feature/*`), pull request, dan CI dengan GitHub Actions.

## Fitur

- Tambah tugas baru
- Tandai tugas selesai / belum selesai
- Hapus tugas

## Menjalankan secara lokal

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Buka `http://localhost:8000`.

## Menjalankan test

```bash
php artisan test
```

## Code style

```bash
vendor/bin/pint --test
```

## Alur kerja branch

- `main` — kode stabil, hanya menerima merge dari `dev` lewat pull request.
- `dev` — branch integrasi, menerima merge dari `feature/*` lewat pull request.
- `feature/*` — branch kerja untuk satu perubahan.

## CI

Workflow `.github/workflows/ci.yml` menjalankan dua job pada setiap push/PR ke `main` dan `dev`:

1. **lint** — cek code style dengan Laravel Pint.
2. **test** — migrasi database SQLite lalu menjalankan test suite PHPUnit.
