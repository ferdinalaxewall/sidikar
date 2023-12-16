# SiDiKar - Sistem Kehadiran Karyawan

## Apa itu SiDiKar?
SiDiKar adalah Sebuah Sistem Informasi untuk Keperluan Absensi Karyawan di Sebuah Instansi dengan Fitur Lacak Lokasi ketika melakukan Presensi.

## Apa saja yang diperlukan?
- PHP Versi 5.6 atau Diatasnya
- MySQL Database
- Web Server (Apache, Nginx, dll) atau bisa menggunakan Built-in PHP Web Server jika sudah support dengan Versi PHP-nya

## Bagaimana Cara Menggunakannya?
- Silahkan Clone atau Download Project ini Terlebih Dahulu.
- Buatlah Database dengan nama "sidikar" pada MySQL Database anda.
- Export file "sidikar.sql" pada MySQL Database anda.
- Coba jalankan terlebih dahulu menggunakan Web Server (Jika menggunakan XAMPP, simpan project ini dalam folder xampp/htdocs).
- Apabila CSS nya tidak terbaca, dan ada beberapa URL yang not found. Anda perlu mengkonfigurasi file "application/config/config.php".
- Silahkan Cari dan Ganti `$config['base_url'] = 'http://localhost:8080';` sesuai dengan URL pada Web Server anda.
