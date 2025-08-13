📌 MyArticle
Aplikasi web untuk mengelola dan berbagi artikel secara online.
Dilengkapi fitur manajemen pengguna, pembuatan dan pengelolaan artikel, komentar, like, serta pencarian artikel.

📜 Description
MyArticle mempermudah pengguna untuk membuat, membaca, dan berinteraksi dengan konten artikel secara online.
Pengguna dapat mengunggah artikel, memberikan komentar, memberi like, serta mencari artikel berdasarkan kata kunci.
Admin memiliki kontrol penuh untuk mengelola seluruh data pengguna dan artikel.

🛠 Technologies Used

Laravel 11 – Backend Framework

MySQL – Database

Tailwind CSS – Styling

JavaScript – Interaktivitas

Composer & NPM – Dependency Management

✨ Features

🔹 Autentikasi & Manajemen Akun

Login, register, dan logout

Edit profil, ganti foto profil, ubah password

Hapus akun

🔹 Manajemen Pengguna (Admin)

Melihat daftar pengguna

Edit data pengguna

Menghapus pengguna

🔹 Manajemen Artikel

Membuat, mengedit, dan menghapus artikel

Upload gambar artikel

Melihat detail artikel

Melihat artikel milik sendiri

Melihat artikel berdasarkan pengguna tertentu

Pencarian artikel berdasarkan judul, isi, atau nama penulis

🔹 Interaksi Konten

Memberi dan membatalkan like pada artikel

Menambahkan komentar

Menghapus komentar

🔹 Fitur Publik

Landing page dengan 6 artikel terbaru

Halaman semua artikel dengan pagination

⚙️ Setup Instructions

Clone repository
git clone https://github.com/username/repo-name.git
cd repo-name

Install dependencies
composer install
npm install

Setup environment

Salin file .env.example menjadi .env

Atur konfigurasi database di file .env

Generate key
php artisan key:generate

Migrate database
php artisan migrate --seed

Run application
php artisan serve

🤖 AI Support Explanation
Jika diintegrasikan dengan AI, MyArticle dapat:

Mencarikan artikel secara cerdas berdasarkan kata kunci

Memberikan rekomendasi artikel berdasarkan riwayat pembaca

Membantu admin membuat ringkasan artikel atau laporan interaksi
