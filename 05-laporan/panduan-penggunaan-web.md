Panduan Penggunaan Sistem Informasi Perpustakaan
Panduan singkat untuk tiga peran: peminjam, petugas, dan admin. Aplikasi dijalankan lewat browser (lokal: http://127.0.0.1:8000).
1. Masuk dan Keluar

    1.  Buka alamat aplikasi di browser.
    2.  Klik Login di pojok kanan atas, lalu isi email dan password.
    3.  Setelah login, halaman sesuai peran akan terbuka: peminjam ke katalog, petugas dan admin ke dashboard.
    4.  Untuk keluar, klik nama pengguna lalu Logout (peminjam) atau Logout di pojok kanan atas (petugas dan admin).
    Pengguna baru dapat mendaftar lewat tombol Register.

2. Panduan Peminjam

2.1 Mencari buku
• Gunakan kolom Cari Buku di halaman katalog, atau menu Kategori untuk menyaring berdasarkan kategori.
• Klik kartu buku untuk melihat detail: judul, penulis, kategori, penerbit, lokasi rak, dan stok.

2.2 Meminjam buku
1.  Di halaman detail buku, klik Keranjang.
2.  Buka menu Keranjang di bagian atas.
3.  Isi Tanggal Pinjam.
4.  Klik Ajukan Peminjaman. Pengajuan akan diteruskan ke petugas dengan sebuah kode pinjam.
5.  Keranjang dibatasi maksimal 2 buku. Untuk membuang buku dari keranjang yang belum diajukan, klik Hapus atau Hapus Masal.
6.  Pada versi yang sudah diperbaiki (v2), pengajuan yang masih berstatus Menunggu diproses petugas dapat dibatalkan dengan tombol Batalkan Pengajuan.

2.3 Mengambil buku
Setelah pengajuan diproses, ambil buku di perpustakaan sesuai lokasi rak dan baris yang tertera. Catat kode pinjam untuk ditunjukkan kepada petugas.

3. Panduan Petugas

3.1 Memproses peminjaman dan pengembalian

1.  Login sebagai petugas, lalu buka menu Transaksi.
2.  Gunakan tombol filter Semua, Belum Dipinjam, Sedang Dipinjam, atau Selesai Dipinjam, atau kolom Search untuk mencari kode pinjam.
3.  Untuk pengajuan berstatus Belum Dipinjam, klik Pinjam. Status berubah menjadi Sedang Dipinjam dan stok buku berkurang.
4.  Saat buku dikembalikan, klik Kembali pada transaksi yang sama. Status menjadi Selesai Dipinjam dan stok bertambah kembali.
5.  Periksa kolom Denda setelah pengembalian.

3.2 Mengelola data buku

1.  Buka Data Master, lalu pilih Buku.
2.  Klik Tambah untuk menambah buku baru. Isi judul, penulis, kategori, penerbit, rak, baris, stok, dan sampul.
3.  Gunakan Lihat, Edit, dan Hapus pada baris buku yang bersangkutan.
4. Panduan Admin
Admin dapat melakukan semua yang dilakukan petugas, ditambah:
• Chart: buka menu Chart, pilih bulan, dan lihat grafik jumlah transaksi Selesai Dipinjam per tanggal.
• User: buka menu User untuk menambah dan mengelola pengguna pada tab Admin, Petugas, dan Peminjam.
• Dashboard: menampilkan ringkasan jumlah buku, peminjam, transaksi selesai, transaksi berjalan, dan grafik.

5. Pesan dan Penanganan Masalah
Situasi
Yang perlu dilakukan
Muncul halaman 403 Forbidden
Akun tidak memiliki hak untuk halaman itu. Login dengan akun yang sesuai.
Buku tidak muncul pada suatu kategori
Kategori tersebut belum memiliki data buku. Hubungi petugas untuk menambahkannya.
Pengajuan tidak muncul di Transaksi petugas
Pastikan Ajukan Peminjaman sudah diklik dan tanggal pinjam terisi.
Stok tidak berubah setelah proses
Muat ulang halaman dan laporkan ke admin bila tetap sama.
Halaman lambat dimuat
Muat ulang halaman dan laporkan ke admin.

6. Kontak Bantuan
Laporkan masalah kepada admin perpustakaan dengan menyebut kode pinjam atau judul buku, serta waktu kejadian.
Catatan: menu dan tombol di atas mengikuti tampilan aplikasi saat pengujian (27 November 2026). Tambahkan tangkapan layar tiap langkah bila diperlukan.