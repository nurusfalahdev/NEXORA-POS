# 🚀 Nexora POS

**Manage Smarter. Sell Better.**

Nexora POS adalah aplikasi Point of Sale (POS) berbasis web yang dirancang untuk membantu pengelolaan bisnis, transaksi penjualan, inventaris, dan laporan secara lebih mudah, cepat, dan efisien.

## ✨ Fitur Utama

- 📊 **Dashboard** — Ringkasan informasi dan statistik penjualan.
- 📦 **Manajemen Produk** — Mengelola data produk dan stok barang.
- 🗂️ **Manajemen Kategori** — Mengelompokkan produk berdasarkan kategori.
- 💰 **Transaksi** — Mengelola proses penjualan.
- 📈 **Laporan** — Menampilkan informasi dan riwayat penjualan.
- 👥 **Manajemen Pengguna** — Mengatur pengguna dan hak akses aplikasi.

## 🛠️ Teknologi

### Backend
- Laravel
- PHP
- MySQL
- REST API

### Frontend
- Vue.js 3
- JavaScript
- Bootstrap 5
- Axios
- Vite

## 📁 Struktur Repository

```text
Nexora-POS/
│
├── backend/          # Laravel REST API
│
├── frontend/         # Vue.js Application
│
├── .gitignore
└── README.md
```

## ⚙️ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/USERNAME/Nexora-POS.git
cd Nexora-POS
```

### 2. Setup Backend

```bash
cd backend

composer install

cp .env.example .env

php artisan key:generate
```

Atur konfigurasi database pada file `.env`, kemudian jalankan:

```bash
php artisan migrate

php artisan serve
```

### 3. Setup Frontend

Buka terminal baru:

```bash
cd frontend

npm install

npm run dev
```

Sesuaikan konfigurasi URL API frontend dengan alamat backend Laravel.

## 🌐 Development Server

| Komponen | Alamat |
|---|---|
| Backend Laravel | http://127.0.0.1:8000 |
| Frontend Vue | http://localhost:5173 |
| Database | MySQL |

## 📌 Status Pengembangan

Nexora POS masih dalam tahap pengembangan. Fitur dan tampilan aplikasi akan terus diperbarui sesuai kebutuhan.

## 👨‍💻 Developer

**Nurus Falah Aditya Hidayat**

Mahasiswa Sistem Informasi | Universitas Terbuka

GitHub: [@nurusfalahdev](https://github.com/nurusfalahdev)

---

<p align="center">
  **Nexora POS**
  <br>
  Manage Smarter. Sell Better.
</p>
