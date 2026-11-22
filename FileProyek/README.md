# CargoMind

CargoMind adalah aplikasi manajemen toko dan gudang berbasis Laravel. Fitur utamanya mencakup inventaris barang, POS dan transaksi, laporan penjualan, ekspor laporan, serta pengaturan pengguna berdasarkan peran.

## Menjalankan secara lokal

Persyaratan: PHP 8.2 atau lebih baru, Composer, dan ekstensi PHP yang dibutuhkan Laravel.

Dari folder `CargoMind-main`, jalankan:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan serve
```

Buka `http://127.0.0.1:8000`. Konfigurasi contoh memakai SQLite dan database sampel yang sudah tersedia di `database/database.sqlite`.

Akun demo (khusus lokal):

| Peran | Email | Kata sandi |
|---|---|---|
| Master | `master@cargomind.com` | `password` |
| Manager | `manager@cargomind.com` | `password` |
| Karyawan | `karyawan@cargomind.com` | `password` |

Ganti kata sandi demo sebelum aplikasi dipublikasikan. Jangan gunakan akun bawaan untuk penggunaan produksi.

## Deployment

Lihat [DEPLOYMENT_GUIDE.md](./DEPLOYMENT_GUIDE.md) untuk panduan deployment ke cPanel.
