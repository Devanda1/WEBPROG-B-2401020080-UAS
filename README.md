# Laravel Game Gallery

Project UAS Web Programming menggunakan PHP Framework Laravel.

## 👤 Identitas
- Nama  : Made Andhika Devanda Wijaya
- NIM   : 2401020080
- Kelas : RSK B

## 📌 Deskripsi Project
Laravel Game Gallery adalah aplikasi web berbasis Laravel yang menampilkan
daftar karakter game. Aplikasi ini memiliki halaman publik untuk melihat
karakter serta halaman admin untuk mengelola data karakter.

## 🛠️ Teknologi yang Digunakan
- PHP 8.x
- Laravel Framework
- MySQL (External Database)
- Blade Template
- HTML, CSS

## ✨ Fitur Aplikasi
- Autentikasi (Login & Register)
- Role Admin
- CRUD Karakter Game
- Upload gambar karakter & background (Storage)
- Halaman publik (tanpa login)
- Halaman admin (login required)
- Database MySQL

## ⚙️ Cara Instalasi
1. Clone repository ini
2. Jalankan perintah:
   ```bash
   composer install

3. Salin file .env.example menjadi .env

4. Atur konfigurasi database MySQL pada file .env

5. Jalankan perintah:

bash
Copy code
php artisan key:generate
php artisan migrate
php artisan storage:link

6. Jalankan server:

bash
Copy code
php artisan serve

7. Akses aplikasi melalui browser:

cpp
Copy code
http://127.0.0.1:8000


##📂 Struktur Database
users

karakters

sessions

cache

migrations

##📎 Catatan
Project ini dibuat untuk memenuhi tugas UAS Web Programming

Repository diset PUBLIC sesuai ketentuan
